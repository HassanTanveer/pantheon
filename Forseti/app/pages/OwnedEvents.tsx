/*  Forseti: personal area & event control panel
 *  Copyright (C) 2023  o.klimenko aka ctizen
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

import * as React from 'react';
import { usePageTitle } from '#/hooks/pageTitle';
import {
  Group,
  Center,
  Container,
  Stack,
  ActionIcon,
  Tooltip,
  Avatar,
  Pagination,
  Space,
  Badge,
  useMantineTheme,
  useMantineColorScheme,
  Modal,
  Text,
  Button,
  Menu,
} from '@mantine/core';
import {
  IconEyeOff,
  IconEye,
  IconTool,
  IconRefreshAlert,
  IconHandStop,
  IconFriends,
  IconTournament,
  IconNetwork,
  IconAlertOctagon,
  IconOlympics,
  IconScript,
  IconTimelineEventPlus,
} from '@tabler/icons-react';
import { Link, Redirect, useLocation } from 'wouter';
import { useApi } from '#/hooks/api';
import { useI18n } from '#/hooks/i18n';
import { useCallback, useContext, useEffect, useState } from 'react';
import { useStorage } from '#/hooks/storage';
import { Event, EventType } from '#/clients/proto/atoms.pb';
import { authCtx } from '#/hooks/auth';
import { useDisclosure } from '@mantine/hooks';
import { nprogress } from '@mantine/nprogress';
import { TopActionButton } from '#/helpers/TopActionButton';

export const OwnedEvents: React.FC<{ params: { page?: string } }> = ({ params: { page } }) => {
  const EVENTS_PERPAGE = 30;
  const api = useApi();
  api.setEventId(0);
  const { isLoggedIn } = useContext(authCtx);
  const i18n = useI18n();
  const storage = useStorage();
  const theme = useMantineTheme();
  const [, navigate] = useLocation();
  const isDark = useMantineColorScheme().colorScheme === 'dark';
  const [stopEventModalOpened, { close: stopEventModalClose, open: stopEventModalOpen }] =
    useDisclosure(false);
  const [stopEventData, setStopEventData] = useState({ id: 0, title: '' });
  const [currentPage, setCurrentPage] = useState(parseInt(page ?? '1', 10));
  const [isLoading, setIsLoading] = useState(true);
  const [isSuperadmin, setIsSuperadmin] = useState(false);
  const [totalPages, setTotalPages] = useState(0);
  const [events, setEvents] = useState<Event[]>([]);
  const [visibilityLoading, setVisibilityLoading] = useState<Record<number, boolean>>({});
  const [scoringLoading, setScoringLoading] = useState<Record<number, boolean>>({});
  usePageTitle(i18n._t('Manage my events'));

  const loadPageData = useCallback(
    (pageToLoad: number) => {
      if (!isLoggedIn || !storage.getPersonId()) {
        setIsLoading(false);
        return;
      }
      nprogress.reset();
      nprogress.start();
      setIsLoading(true);
      Promise.all([
        api.getOwnedEventIds(storage.getPersonId()!),
        api.getSuperadminFlag(storage.getPersonId()!),
      ])
        .then(([eventsList, superadmin]) => {
          setIsSuperadmin(superadmin);
          const pageOffset = (pageToLoad - 1) * EVENTS_PERPAGE;
          if (eventsList.includes(-1)) {
            // -1 === global privileges
            api.getEvents(EVENTS_PERPAGE, pageOffset, false).then((resp) => {
              setEvents(resp.events);
              setTotalPages(Math.ceil(resp.total / EVENTS_PERPAGE));
              setIsLoading(false);
              nprogress.complete();
            });
          } else {
            const eventIds = eventsList.slice(pageOffset, pageOffset + EVENTS_PERPAGE);
            api.getEventsById(eventIds).then((resp) => {
              setEvents(resp);
              setTotalPages(Math.ceil(eventsList.length / EVENTS_PERPAGE));
              setIsLoading(false);
              nprogress.complete();
            });
          }
        })
        .catch(() => {
          setIsLoading(false);
          nprogress.complete();
        });
    },
    [isLoggedIn]
  );

  const setPage = useCallback(
    (newpage: number) => {
      setCurrentPage(newpage);
      loadPageData(newpage);
    },
    [isLoggedIn]
  );

  const toggleVisibility = (id: number) => {
    setVisibilityLoading({ ...scoringLoading, [id]: true });
    api.toggleListed(id).then((resp) => {
      if (resp) {
        const idx = events.findIndex((ev) => ev.id === id);
        setEvents([
          ...events.slice(0, idx),
          { ...events[idx], isListed: !events[idx].isListed },
          ...events.slice(idx + 1),
        ]);
      }
      setVisibilityLoading({ ...scoringLoading, [id]: false });
    });
  };

  const rebuildScoring = (id: number) => {
    setScoringLoading({ ...scoringLoading, [id]: true });
    api.rebuildScoring(id).finally(() => {
      setScoringLoading({ ...scoringLoading, [id]: false });
    });
  };

  const stopEvent = (id: number) => {
    api.finishEvent(id).then((resp) => {
      if (resp) {
        const idx = events.findIndex((ev) => ev.id === id);
        setEvents([
          ...events.slice(0, idx),
          { ...events[idx], finished: true },
          ...events.slice(idx + 1),
        ]);
      }
    });
  };

  // Initial load
  useEffect(() => loadPageData(1), [isLoggedIn]);

  if (!storage.getPersonId()) {
    return <Redirect to='/profile/login' />;
  }

  return isLoading ? null : (
    <>
      <Modal opened={stopEventModalOpened} onClose={stopEventModalClose} size='auto' centered>
        <Text>
          {i18n._t('Stop event "%1" (id #%2)? This action can\'t be undone!', [
            stopEventData.title,
            stopEventData.id,
          ])}
        </Text>
        <Group mt='xl' grow>
          <Button variant='outline' onClick={stopEventModalClose}>
            {i18n._t('Cancel')}
          </Button>
          <Button
            color='red'
            variant='filled'
            onClick={() => {
              stopEvent(stopEventData.id);
              stopEventModalClose();
            }}
          >
            {i18n._t('Stop event')}
          </Button>
        </Group>
      </Modal>
      <Container pos='relative' sx={{ minHeight: '400px' }}>
        <Stack justify='flex-start' spacing='0'>
          {events.map((event, idx) => {
            return (
              <Group
                key={`ev_${idx}`}
                style={{
                  padding: '10px',
                  backgroundColor:
                    idx % 2
                      ? isDark
                        ? theme.colors.dark[7]
                        : theme.colors.gray[1]
                      : 'transparent',
                }}
              >
                <Group sx={{ flex: 1 }}>
                  {event.type === EventType.EVENT_TYPE_LOCAL && (
                    <Tooltip
                      openDelay={500}
                      position='bottom'
                      withArrow
                      label={i18n._t('Local rating')}
                    >
                      <Avatar color='green' radius='xl'>
                        <IconFriends />
                      </Avatar>
                    </Tooltip>
                  )}
                  {event.type === EventType.EVENT_TYPE_TOURNAMENT && (
                    <Tooltip
                      openDelay={500}
                      position='bottom'
                      withArrow
                      label={i18n._t('Tournament')}
                    >
                      <Avatar color='red' radius='xl'>
                        <IconTournament />
                      </Avatar>
                    </Tooltip>
                  )}
                  {event.type === EventType.EVENT_TYPE_ONLINE && (
                    <Tooltip
                      openDelay={500}
                      position='bottom'
                      withArrow
                      label={i18n._t('Online event')}
                    >
                      <Avatar color='blue' radius='xl'>
                        <IconNetwork />
                      </Avatar>
                    </Tooltip>
                  )}
                  <a href={`${window.__cfg.RHEDA_URL}/eid${event.id}`} target='_blank'>
                    {event.title}
                  </a>
                </Group>
                <Group position='right'>
                  {!event.finished && (
                    <Menu shadow='md' width={200}>
                      <Menu.Target>
                        <Button color='grape'>{i18n._t('Actions')}</Button>
                      </Menu.Target>
                      <Menu.Dropdown>
                        <Menu.Label>{i18n._t('Event management')}</Menu.Label>
                        {event.isPrescripted && (
                          <Link to={`/event/${event.id}/prescript`}>
                            <Menu.Item
                              title={i18n._t('Manage predefined seating')}
                              icon={<IconScript />}
                            >
                              {i18n._t('Predefined seating')}
                            </Menu.Item>
                          </Link>
                        )}
                        <Link to={`/event/${event.id}/games`}>
                          <Menu.Item
                            title={i18n._t('Manage current games')}
                            icon={<IconOlympics />}
                          >
                            {i18n._t('Manage games')}
                          </Menu.Item>
                        </Link>
                        <Link to={`/event/${event.id}/penalties`}>
                          <Menu.Item
                            title={i18n._t('Manage penalties')}
                            icon={<IconAlertOctagon />}
                          >
                            {i18n._t('Penalties')}
                          </Menu.Item>
                        </Link>
                        <Link to={`/event/${event.id}/players`}>
                          <Menu.Item title={i18n._t('Manage players')} icon={<IconFriends />}>
                            {i18n._t('Manage players')}
                          </Menu.Item>
                        </Link>
                        <Link to={`/ownedEvents/edit/${event.id}`}>
                          <Menu.Item title={i18n._t('Edit event settings')} icon={<IconTool />}>
                            {i18n._t('Settings')}
                          </Menu.Item>
                        </Link>

                        <Menu.Divider />
                        <Menu.Label>{i18n._t('Danger zone')}</Menu.Label>
                        {isSuperadmin && (
                          <Menu.Item
                            title={i18n._t('Rebuild scoring')}
                            onClick={() => rebuildScoring(event.id)}
                            icon={<IconRefreshAlert />}
                          >
                            {i18n._t('Rebuild scoring')}
                          </Menu.Item>
                        )}
                        <Menu.Item
                          title={i18n._t('Finish event')}
                          color='red'
                          icon={<IconHandStop />}
                          onClick={() => {
                            setStopEventData({ id: event.id, title: event.title });
                            stopEventModalOpen();
                          }}
                        >
                          {i18n._t('Finish event')}
                        </Menu.Item>
                      </Menu.Dropdown>
                    </Menu>
                  )}

                  {event.finished && (
                    <Badge color='pink' variant='outline'>
                      {i18n._t('Event finished')}
                    </Badge>
                  )}

                  <ActionIcon
                    title={i18n._t('Toggle visibility in ratings global list')}
                    loading={visibilityLoading[event.id]}
                    variant='filled'
                    size='lg'
                    color='gray'
                    onClick={() => toggleVisibility(event.id)}
                  >
                    {event.isListed ? <IconEye /> : <IconEyeOff />}
                  </ActionIcon>
                </Group>
              </Group>
            );
          })}
        </Stack>
        <TopActionButton
          title={i18n._t('Create new event')}
          loading={false}
          disabled={false}
          icon={<IconTimelineEventPlus />}
          onClick={() => {
            navigate('/ownedEvents/new');
          }}
        />
      </Container>
      {totalPages > 1 && (
        <>
          <Space h='xl' />
          <Center>
            <Pagination total={totalPages} siblings={2} value={currentPage} onChange={setPage} />
          </Center>
        </>
      )}
    </>
  );
};

<?php
/*  Rheda: visualizer and control panel
 *  Copyright (C) 2016  o.klimenko aka ctizen
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
namespace Rheda;

require_once __DIR__ . '/../helpers/Array.php';

class Timer extends Controller
{
    protected $_mainTemplate = 'Timer';

    protected function _pageTitle()
    {
        return _t('Timer') . ' - ' . $this->_mainEventGameConfig->getEventTitle();
    }

    /**
     * @return array
     * @throws \Exception
     */
    protected function _run(): array
    {
        if (count($this->_eventIdList) > 1) {
            return [
                'isAggregated' => true,
                'error' => _t('Page not available for aggregated events')
            ];
        }

        if (empty($this->_mainEventId)) {
            return [
                'error' => _t('Main event is empty: this is unexpected behavior')
            ];
        }

        $timerState = $this->_mimir->getTimerState($this->_mainEventId);
        $autostartTimer = $this->_mimir->getStartingTimer($this->_mainEventId);
        $remaining = $timerState['time_remaining'];
        $currentSeating = $this->_formatSeating($this->_mimir->getCurrentSeating($this->_mainEventId));
        $durationWithoutSeating = $this->_mainEventGameConfig->getGameDuration() - 5;

        if ($timerState['started'] && $timerState['time_remaining']) {
            $formattedTime = (int)($remaining / 60) . ':'
                           . (floor(($remaining % 60) / 10) * 10);
            return [
                'startingTimer' => $autostartTimer ?: '0',
                'haveStartingTimer' => $autostartTimer > 0,
                'waiting' => $this->_mainEventGameConfig->getGamesStatus() === \Common\TournamentGamesStatus::TOURNAMENT_GAMES_STATUS_SEATING_READY,
                'gameDurationWithoutSeating' => $durationWithoutSeating,
                'initialTime' => $formattedTime,
                'seating' => $currentSeating
            ];
        }

        return [
            'startingTimer' => $autostartTimer ?: '0',
            'haveStartingTimer' => $autostartTimer > 0,
            'waiting' => $this->_mainEventGameConfig->getGamesStatus() === \Common\TournamentGamesStatus::TOURNAMENT_GAMES_STATUS_SEATING_READY,
            'gameDurationWithoutSeating' => $durationWithoutSeating,
            'initialTime' => $this->_mainEventGameConfig->getGamesStatus() === \Common\TournamentGamesStatus::TOURNAMENT_GAMES_STATUS_SEATING_READY ? '99:99' : '00:00',
            'seating' => $currentSeating
        ];
    }

    /**
     * @param array $seating
     * @return array
     * @throws \Exception
     */
    protected function _formatSeating(array $seating): array
    {
        $result = [];

        // assign colors first
        foreach ($seating as &$player) {
            $player['zone'] = $player['rating'] >= $this->_mainEventGameConfig->getRulesetConfig()?->getStartRating() ? 'success' : 'danger';
        }

        $seating = ArrayHelpers::elm2key($seating, 'session_id', true);

        foreach ($seating as $table) {
            usort($table, function ($e1, $e2) {
                return $e1['order'] - $e2['order'];
            });
            $result []= [
                'index' => $table[0]['table_index'],
                'players' => $table
            ];
        }

        usort($result, function ($e1, $e2) {
            return $e1['index'] - $e2['index'];
        });

        return $result;
    }
}

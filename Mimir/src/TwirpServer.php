<?php

namespace Mimir;

require_once __DIR__ . '/../../Common/Storage.php';
require_once __DIR__ . '/Config.php';
require_once __DIR__ . '/DataSource.php';
require_once __DIR__ . '/Db.php';
require_once __DIR__ . '/Meta.php';
require_once __DIR__ . '/ErrorHandler.php';
require_once __DIR__ . '/FreyClientTwirp.php';
require_once __DIR__ . '/controllers/Events.php';
require_once __DIR__ . '/controllers/Games.php';
require_once __DIR__ . '/controllers/Misc.php';
require_once __DIR__ . '/controllers/Players.php';
require_once __DIR__ . '/controllers/Seating.php';

use Common\AbortResult;
use Common\Achievement;
use Common\ChomboResult;
use Common\Country;
use Common\CurrentSession;
use Common\DoraSummary;
use Common\DrawResult;
use Common\Event;
use Common\EventData;
use Common\PlayerSeating;
use Common\PlayerSeatingSwiss;
use Common\PrescriptedTable;
use Common\SessionHistoryResultTable;
use Common\Storage;
use Common\TableItemSwiss;
use Common\TeamMapping;
use Common\EventsGetAchievementsPayload;
use Common\EventsGetAchievementsResponse;
use Common\EventsGetAllRegisteredPlayersPayload;
use Common\EventsGetAllRegisteredPlayersResponse;
use Common\EventsGetCountriesPayload;
use Common\EventsGetCountriesResponse;
use Common\EventsGetCurrentSeatingResponse;
use Common\EventsGetEventForEditPayload;
use Common\EventsGetEventForEditResponse;
use Common\EventsGetEventsPayload;
use Common\EventsGetEventsResponse;
use Common\EventsGetEventsByIdPayload;
use Common\EventsGetEventsByIdResponse;
use Common\EventsGetGamePayload;
use Common\EventsGetGameResponse;
use Common\EventsGetGamesSeriesResponse;
use Common\EventsGetLastGamesPayload;
use Common\EventsGetLastGamesResponse;
use Common\EventsGetPrescriptedEventConfigResponse;
use Common\EventsGetRatingTablePayload;
use Common\EventsGetRatingTableResponse;
use Common\EventsGetRulesetsPayload;
use Common\EventsGetRulesetsResponse;
use Common\EventsGetStartingTimerResponse;
use Common\EventsGetTablesStateResponse;
use Common\EventsGetTimerStateResponse;
use Common\EventsGetTimezonesPayload;
use Common\EventsGetTimezonesResponse;
use Common\EventsRegisterPlayerPayload;
use Common\EventsUnregisterPlayerPayload;
use Common\EventsUpdateEventPayload;
use Common\EventsUpdatePlayerReplacementPayload;
use Common\EventsUpdatePlayerSeatingFlagPayload;
use Common\EventsUpdatePlayersLocalIdsPayload;
use Common\EventsUpdatePlayersTeamsPayload;
use Common\EventsUpdatePrescriptedEventConfigPayload;
use Common\EventType;
use Common\FinalResultOfSession;
use Common\GameConfig;
use Common\GameResult;
use Common\GamesAddOnlineReplayPayload;
use Common\GamesAddOnlineReplayResponse;
use Common\GamesAddPenaltyPayload;
use Common\GamesAddPenaltyGamePayload;
use Common\GamesAddPenaltyGameResponse;
use Common\GamesAddRoundPayload;
use Common\GamesAddRoundResponse;
use Common\GamesCancelGamePayload;
use Common\GamesDefinalizeGamePayload;
use Common\GamesDropLastRoundPayload;
use Common\GamesEndGamePayload;
use Common\GamesGetSessionOverviewPayload;
use Common\GamesGetSessionOverviewResponse;
use Common\GamesPreviewRoundPayload;
use Common\GamesPreviewRoundResponse;
use Common\GamesStartGamePayload;
use Common\GamesStartGameResponse;
use Common\GenericEventPayload;
use Common\GenericSuccessResponse;
use Common\HandValueStat;
use Common\IntermediateResultOfSession;
use Common\LocalIdMapping;
use Common\Mimir;
use Common\MiscAddErrorLogPayload;
use Common\MultironResult;
use Common\MultironWin;
use Common\MyEvent;
use Common\NagashiResult;
use Common\PaymentLog;
use Common\PaymentLogItem;
use Common\Penalty;
use Common\PlacesSummaryItem;
use Common\Player;
use Common\PlayerInRating;
use Common\PlayerInSession;
use Common\PlayerPlaceInSeries;
use Common\PlayersGetAllRoundsPayload;
use Common\PlayersGetAllRoundsResponse;
use Common\PlayersGetCurrentSessionsPayload;
use Common\PlayersGetCurrentSessionsResponse;
use Common\PlayersGetLastResultsPayload;
use Common\PlayersGetLastResultsResponse;
use Common\PlayersGetLastRoundPayload;
use Common\PlayersGetLastRoundResponse;
use Common\PlayersGetLastRoundByHashPayload;
use Common\PlayersGetLastRoundByHashResponse;
use Common\PlayersGetMyEventsPayload;
use Common\PlayersGetMyEventsResponse;
use Common\PlayersGetPlayerPayload;
use Common\PlayersGetPlayerResponse;
use Common\PlayersGetPlayerStatsPayload;
use Common\PlayersGetPlayerStatsResponse;
use Common\PlayerWinSummary;
use Common\RegisteredPlayer;
use Common\ReplacementPlayer;
use Common\RiichiSummary;
use Common\RonResult;
use Common\Round;
use Common\RoundOutcome;
use Common\RoundState;
use Common\SeatingGenerateSwissSeatingResponse;
use Common\SeatingGetNextPrescriptedSeatingResponse;
use Common\SeatingMakeIntervalSeatingPayload;
use Common\SeatingMakePrescriptedSeatingPayload;
use Common\SeatingMakeShuffledSeatingPayload;
use Common\SeriesResult;
use Common\SessionHistoryResult;
use Common\SessionStatus;
use Common\TableState;
use Common\TournamentGamesStatus;
use Common\TsumoResult;
use Common\TwirpError;
use Common\YakuStat;
use Exception;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Logger;

final class TwirpServer implements Mimir
{
    protected EventsController $_eventsController;
    protected GamesController $_gamesController;
    protected PlayersController $_playersController;
    protected SeatingController $_seatingController;
    protected MiscController $_miscController;
    protected IDb $_db;
    protected IFreyClient $_frey;
    protected DataSource $_ds;
    protected Logger $_syslog;
    protected Meta $_meta;
    protected Config $_config;
    protected Storage $_storage;

    /**
     * @param ?string $configPath
     * @throws Exception
     */
    public function __construct($configPath = '')
    {
        $cfgPath = empty($configPath) ? __DIR__ . '/../config/index.php' : $configPath;
        $this->_config = new Config($cfgPath);
        date_default_timezone_set($this->_config->getStringValue('serverDefaultTimezone') ?: 'UTC');
        $this->_storage = new \Common\Storage($this->_config->getStringValue('cookieDomain'));
        $this->_db = new Db($this->_config);
        $freyUrl = $this->_config->getStringValue('freyUrl');
        if ($freyUrl === '__mock__') { // testing purposes
            $this->_frey = new FreyClientMock('');
        } else {
            $this->_frey = new FreyClientTwirp($freyUrl);
        }
        $this->_ds = new DataSource($this->_db, $this->_frey);
        $this->_meta = new Meta($this->_frey, $this->_storage, $this->_config, $_SERVER);
        $this->_syslog = new Logger('RiichiApi');
        $this->_syslog->pushHandler(new ErrorLogHandler());

        // + some custom handler for testing errors
        if ($this->_config->getBooleanValue('verbose')) {
            (new ErrorHandler($this->_config, $this->_syslog))->register();
        }

        $this->_eventsController = new EventsController($this->_ds, $this->_syslog, $this->_config, $this->_meta);
        $this->_gamesController = new GamesController($this->_ds, $this->_syslog, $this->_config, $this->_meta);
        $this->_playersController = new PlayersController($this->_ds, $this->_syslog, $this->_config, $this->_meta);
        $this->_seatingController = new SeatingController($this->_ds, $this->_syslog, $this->_config, $this->_meta);
        $this->_miscController = new MiscController($this->_ds, $this->_syslog, $this->_config, $this->_meta);
    }

    protected static function _toPaymentLogItem(string $key, int $value): PaymentLogItem
    {
        [$to, $from] = explode('<-', $key);
        $item = (new PaymentLogItem())
            ->setAmount((int)$value);
        if (!empty($to)) {
            $item->setTo((int)$to);
        }
        if (!empty($from)) {
            $item->setFrom((int)$from);
        }
        return $item;
    }

    protected static function _toPaymentsLog(array $paymentsInfo): PaymentLog
    {
        return (new PaymentLog())
            /** @phpstan-ignore-next-line */
            ->setDirect(array_map('self::_toPaymentLogItem', array_keys($paymentsInfo['direct']), array_values($paymentsInfo['direct'])))
            /** @phpstan-ignore-next-line */
            ->setRiichi(array_map('self::_toPaymentLogItem', array_keys($paymentsInfo['riichi']), array_values($paymentsInfo['riichi'])))
            /** @phpstan-ignore-next-line */
            ->setHonba(array_map('self::_toPaymentLogItem', array_keys($paymentsInfo['honba']), array_values($paymentsInfo['honba'])));
    }

    /**
     * @param string|array $csepStringOrArray
     * @return int[]
     */
    protected static function _toIntArray($csepStringOrArray): array
    {
        if (is_string($csepStringOrArray)) {
            return array_unique(array_filter(array_map('intval', explode(',', $csepStringOrArray))));
        } else {
            return array_unique(array_filter(array_map('intval', $csepStringOrArray)));
        }
    }

    /**
     * @param array $scoreHistory
     * @return SessionHistoryResult[]
     */
    protected static function _toResultsHistory(array $scoreHistory): array
    {
        return array_map(function ($result) {
            return (new SessionHistoryResult())
                ->setSessionHash($result['session_hash'])
                ->setEventId($result['event_id'])
                ->setTitle($result['title'])
                ->setPlayerId($result['player_id'])
                ->setScore($result['score'])
                ->setRatingDelta($result['rating_delta'])
                ->setPlace($result['place']);
        }, $scoreHistory);
    }

    /**
     * @param string $val
     * @return int
     */
    protected static function _toOutcome(string $val): int
    {
        return match ($val) {
            'ron' => RoundOutcome::ROUND_OUTCOME_RON,
            'tsumo' => RoundOutcome::ROUND_OUTCOME_TSUMO,
            'draw' => RoundOutcome::ROUND_OUTCOME_DRAW,
            'abort' => RoundOutcome::ROUND_OUTCOME_ABORT,
            'chombo' => RoundOutcome::ROUND_OUTCOME_CHOMBO,
            'nagashi' => RoundOutcome::ROUND_OUTCOME_NAGASHI,
            'multiron' => RoundOutcome::ROUND_OUTCOME_MULTIRON,
            default => throw new InvalidParametersException()
        };
    }

    protected static function _toTableStatus(string $val): int
    {
        return match ($val) {
            'planned' => SessionStatus::SESSION_STATUS_PLANNED,
            'inprogress' => SessionStatus::SESSION_STATUS_INPROGRESS,
            'prefinished' => SessionStatus::SESSION_STATUS_PREFINISHED,
            'finished' => SessionStatus::SESSION_STATUS_FINISHED,
            'cancelled' => SessionStatus::SESSION_STATUS_CANCELLED,
            default => throw new InvalidParametersException()
        };
    }

    protected static function _toEventData(array $ret): EventData
    {
        $data = (new EventData())
            ->setType($ret['isOnline']
                ? EventType::EVENT_TYPE_ONLINE
                : ($ret['isTournament']
                    ? EventType::EVENT_TYPE_TOURNAMENT
                    : EventType::EVENT_TYPE_LOCAL))
            ->setTitle($ret['title'])
            ->setDescription($ret['description'])
            ->setTimezone($ret['timezone'])
            ->setSeriesLength($ret['seriesLength'])
            ->setMinGames($ret['minGames'])
            ->setIsTeam($ret['isTeam'])
            ->setIsListed($ret['isListed'])
            ->setIsPrescripted($ret['isPrescripted'])
            ->setAutostart($ret['autostart'])
            ->setRulesetConfig($ret['ruleset']);
        if (!empty($ret['duration'])) {
            $data->setDuration($ret['duration']);
        }
        if (!empty($ret['lobbyId'])) {
            $data->setLobbyId($ret['lobbyId']);
        }
        return $data;
    }

    protected static function _toRoundState(array $ret): RoundState
    {
        return (new RoundState())
            ->setOutcome(self::_toOutcome($ret['outcome']))
            ->setRound(self::_formatRound($ret))
            ->setRiichiIds(self::_toIntArray($ret['riichiIds']))
            ->setDealer($ret['dealer'])
            ->setRoundIndex($ret['round'])
            ->setRiichi($ret['riichi'])
            ->setHonba($ret['honba'])
            ->setPayments(self::_toPaymentsLog($ret['payments']))
            ->setSessionHash($ret['session_hash'])
            ->setScores(self::_makeScores($ret['scores_before']))
            ->setScoresDelta(self::_makeScores($ret['scores_delta']))
            ;
    }

    /**
     * @param array $result
     * @return YakuStat[]
     */
    protected static function _toYakuStat(array $result): array
    {
        $ret = [];
        foreach ($result as $yakuId => $count) {
            $ret []= (new YakuStat())
                ->setYakuId($yakuId)
                ->setCount($count);
        }
        return $ret;
    }

    protected static function _toGamesStatus(string $status): int
    {
        return match ($status) {
            'seating_ready' => TournamentGamesStatus::TOURNAMENT_GAMES_STATUS_SEATING_READY,
            'started' => TournamentGamesStatus::TOURNAMENT_GAMES_STATUS_STARTED,
            default => TournamentGamesStatus::TOURNAMENT_GAMES_STATUS_UNSPECIFIED
        };
    }

    /**
     * @param array $result
     * @return HandValueStat[]
     */
    protected static function _toHandValueStat(array $result): array
    {
        $ret = [];
        foreach ($result as $han => $count) {
            $ret []= (new HandValueStat())
                ->setHanCount($han)
                ->setCount($count);
        }
        return $ret;
    }

    /**
     * @param array $result
     * @return IntermediateResultOfSession[]
     */
    protected static function _makeScores(array $result): array
    {
        $ret = [];
        foreach ($result as $id => $score) {
            $ret []= (new IntermediateResultOfSession())
                ->setPlayerId($id)
                ->setScore($score);
        }
        return $ret;
    }

    /**
     * @param array $result
     * @return PlacesSummaryItem[]
     */
    protected static function _toPlacesSummary(array $result): array
    {
        $ret = [];
        foreach ($result as $place => $count) {
            $ret []= (new PlacesSummaryItem())
                ->setPlace($place)
                ->setCount($count);
        }
        return $ret;
    }

    /**
     * @param array $result
     * @return Penalty[]
     */
    protected static function _makePenalties(array $result): array
    {
        $ret = [];
        foreach ($result as $id => $score) {
            $ret []= (new Penalty())
                ->setWho($id)
                ->setAmount($score);
        }
        return $ret;
    }

    /**
     * @param array $result
     * @return Penalty[]
     */
    protected static function _toPenaltiesLog(array $result): array
    {
        return array_map(function ($penalty) {
            return (new Penalty())
                ->setAmount($penalty['amount'])
                ->setWho($penalty['who'])
                ->setReason($penalty['reason']);
        }, $result);
    }

    /**
     * @param string $val
     * @return int
     */
    protected static function _toEventTypeEnum($val): int
    {
        return match ($val) {
            'online' => EventType::EVENT_TYPE_ONLINE,
            'tournament' => EventType::EVENT_TYPE_TOURNAMENT,
            default => EventType::EVENT_TYPE_LOCAL,
        };
    }

    /**
     * @param int $val
     * @return string
     */
    protected static function _fromEventTypeEnum(int $val): string
    {
        return match ($val) {
            EventType::EVENT_TYPE_ONLINE => 'online',
            EventType::EVENT_TYPE_TOURNAMENT => 'tournament',
            default => 'club',
        };
    }

    /**
     * @param array $players
     * @return Player[]
     */
    protected static function _toPlayers(array $players): array
    {
        return array_map(function ($player) {
            return (new Player())
                ->setId($player['id'])
                ->setTitle($player['title'])
                ->setTenhouId($player['tenhou_id']);
        }, $players);
    }

    /**
     * @param array $players
     * @return RegisteredPlayer[]
     */
    protected static function _toRegisteredPlayers(array $players): array
    {
        return array_map(function ($player) {
            $reg = (new RegisteredPlayer())
                ->setId($player['id'])
                ->setTitle($player['title'])
                ->setTenhouId($player['tenhou_id'])
                ->setIgnoreSeating($player['ignore_seating']);
            $repl = self::_replacement($player);
            if (!empty($repl)) {
                $reg->setReplacedBy($repl);
            }
            if (!empty($player['local_id'])) {
                $reg->setLocalId($player['local_id']);
            }
            if (!empty($player['team_name'])) {
                $reg->setTeamName($player['team_name']);
            }
            return $reg;
        }, $players);
    }

    /**
     * @param array $player
     * @return ReplacementPlayer|null
     */
    protected static function _replacement(array $player): ?ReplacementPlayer
    {
        return empty($player['replaced_by'])
            ? null
            : (new ReplacementPlayer())
                ->setId($player['replaced_by']['id'])
                ->setTitle($player['replaced_by']['title']);
    }

    /**
     * @param array $r
     * @return Round
     * @throws TwirpError
     */
    protected static function _formatRound(array $r): Round
    {
        $round = new Round();

        switch ($r['outcome']) {
            case 'ron':
                $res = (new RonResult())
                    ->setRoundIndex($r['round_index'])
                    ->setHonba($r['honba'])
                    ->setWinnerId($r['winner_id'])
                    ->setLoserId($r['loser_id'])
                    ->setHan($r['han'])
                    ->setFu($r['fu'] ?? 0)
                    ->setYaku(self::_toIntArray($r['yaku']))
                    ->setRiichiBets(self::_toIntArray($r['riichi_bets']))
                    ->setDora($r['dora'] ?? 0)
                    ->setUradora($r['uradora'] ?? 0)
                    ->setKandora($r['kandora'] ?? 0)
                    ->setKanuradora($r['kanuradora'] ?? 0)
                    ->setOpenHand($r['open_hand']);
                if (!empty($r['pao_player_id'])) {
                    $res->setPaoPlayerId($r['pao_player_id']);
                }
                $round->setRon($res);
                break;
            case 'multiron':
                $round->setMultiron((new MultironResult())
                    ->setRoundIndex($r['round_index'])
                    ->setHonba($r['honba'])
                    ->setLoserId($r['loser_id'])
                    ->setMultiRon($r['multi_ron'])
                    ->setRiichiBets(self::_toIntArray($r['riichi_bets']))
                    ->setWins(array_map(function ($win) {
                        $res = (new MultironWin())
                            ->setWinnerId($win['winner_id'])
                            ->setHan($win['han'])
                            ->setFu($win['fu'] ?? 0)
                            ->setYaku(self::_toIntArray($win['yaku']))
                            ->setDora($win['dora'] ?? 0)
                            ->setUradora($win['uradora'] ?? 0)
                            ->setKandora($win['kandora'] ?? 0)
                            ->setKanuradora($win['kanuradora'] ?? 0)
                            ->setOpenHand($win['open_hand']);
                        if (!empty($win['pao_player_id'])) {
                            $res->setPaoPlayerId($win['pao_player_id']);
                        }
                        return $res;
                    }, $r['wins'])));
                break;
            case 'tsumo':
                $res = (new TsumoResult())
                    ->setRoundIndex($r['round_index'])
                    ->setHonba($r['honba'])
                    ->setWinnerId($r['winner_id'])
                    ->setHan($r['han'])
                    ->setFu($r['fu'] ?? 0)
                    ->setYaku(self::_toIntArray($r['yaku']))
                    ->setRiichiBets(self::_toIntArray($r['riichi_bets']))
                    ->setDora($r['dora'] ?? 0)
                    ->setUradora($r['uradora'] ?? 0)
                    ->setKandora($r['kandora'] ?? 0)
                    ->setKanuradora($r['kanuradora'] ?? 0)
                    ->setOpenHand($r['open_hand']);
                if (!empty($r['pao_player_id'])) {
                    $res->setPaoPlayerId($r['pao_player_id']);
                }
                $round->setTsumo($res);
                break;
            case 'draw':
                $round->setDraw((new DrawResult())
                    ->setRoundIndex($r['round_index'])
                    ->setHonba($r['honba'])
                    ->setRiichiBets(self::_toIntArray($r['riichi_bets']))
                    ->setTempai(self::_toIntArray($r['tempai'])));
                break;
            case 'abort':
                $round->setAbort((new AbortResult())
                    ->setRoundIndex($r['round_index'])
                    ->setHonba($r['honba'])
                    ->setRiichiBets(self::_toIntArray($r['riichi_bets'])));
                break;
            case 'chombo':
                $round->setChombo((new ChomboResult())
                    ->setRoundIndex($r['round_index'])
                    ->setHonba($r['honba'])
                    ->setLoserId($r['loser_id']));
                break;
            case 'nagashi':
                $round->setNagashi((new NagashiResult())
                    ->setRoundIndex($r['round_index'])
                    ->setHonba($r['honba'])
                    ->setRiichiBets(self::_toIntArray($r['riichi_bets']))
                    ->setTempai(self::_toIntArray($r['tempai']))
                    ->setNagashi(self::_toIntArray($r['nagashi'])));
                break;
            default:
                throw new TwirpError('500', 'Unsupported outcome specified');
        }

        return $round;
    }

    /**
     * @param \Traversable|null $input
     * @return array
     */
    protected static function _toArray(?\Traversable $input)
    {
        if (empty($input)) {
            return [];
        }
        return iterator_to_array($input);
    }

    /**
     * @param Round[] $rounds
     * @return array
     * @throws TwirpError
     */
    protected static function _toPlainRoundData(array $rounds): array
    {

        return array_map(function ($round) {
            return match ($round->getOutcome()) {
                'ron' => [
                    'outcome' => 'ron',
                    'round_index' => $round->getRon()?->getRoundIndex(),
                    'honba' => $round->getRon()?->getHonba(),
                    'yaku' => implode(',', self::_toArray($round->getRon()?->getYaku())),
                    'riichi_bets' => implode(',', self::_toArray($round->getRon()?->getRiichiBets())),
                    'riichi' => implode(',', self::_toArray($round->getRon()?->getRiichiBets())),
                    'winner_id' => $round->getRon()?->getWinnerId(),
                    'loser_id' => $round->getRon()?->getLoserId(),
                    'pao_player_id' => $round->getRon()?->getPaoPlayerId(),
                    'han' => $round->getRon()?->getHan(),
                    'fu' => $round->getRon()?->getFu(),
                    'dora' => $round->getRon()?->getDora(),
                    'uradora' => $round->getRon()?->getUradora(),
                    'kandora' => $round->getRon()?->getKandora(),
                    'kanuradora' => $round->getRon()?->getKanuradora(),
                    'open_hand' => $round->getRon()?->getOpenHand(),
                ],
                'multiron' => [
                    'outcome' => 'multiron',
                    'round_index' => $round->getMultiron()?->getRoundIndex(),
                    'honba' => $round->getMultiron()?->getHonba(),
                    'loser_id' => $round->getMultiron()?->getLoserId(),
                    'multi_ron' => $round->getMultiron()?->getMultiRon(),
                    'riichi_bets' => implode(',', self::_toArray($round->getMultiron()?->getRiichiBets())),
                    'riichi' => implode(',', self::_toArray($round->getMultiron()?->getRiichiBets())),
                    'wins' => array_map(function (MultironWin $win) use ($round) {
                        return [
                            'yaku' => implode(',', self::_toArray($win->getYaku())),
                            'riichi_bets' => implode(',', self::_toArray($round->getMultiron()?->getRiichiBets())),
                            'riichi' => implode(',', self::_toArray($round->getMultiron()?->getRiichiBets())),
                            'winner_id' => $win->getWinnerId(),
                            'pao_player_id' => $win->getPaoPlayerId(),
                            'han' => $win->getHan(),
                            'fu' => $win->getFu(),
                            'dora' => $win->getDora(),
                            'uradora' => $win->getUradora(),
                            'kandora' => $win->getKandora(),
                            'kanuradora' => $win->getKanuradora(),
                            'open_hand' => $win->getOpenHand(),
                        ];
                    }, self::_toArray($round->getMultiron()?->getWins()))
                ],
                'tsumo' => [
                    'outcome' => 'tsumo',
                    'round_index' => $round->getTsumo()?->getRoundIndex(),
                    'honba' => $round->getTsumo()?->getHonba(),
                    'yaku' => implode(',', self::_toArray($round->getTsumo()?->getYaku())),
                    'riichi_bets' => implode(',', self::_toArray($round->getTsumo()?->getRiichiBets())),
                    'riichi' => implode(',', self::_toArray($round->getTsumo()?->getRiichiBets())),
                    'winner_id' => $round->getTsumo()?->getWinnerId(),
                    'pao_player_id' => $round->getTsumo()?->getPaoPlayerId(),
                    'han' => $round->getTsumo()?->getHan(),
                    'fu' => $round->getTsumo()?->getFu(),
                    'dora' => $round->getTsumo()?->getDora(),
                    'uradora' => $round->getTsumo()?->getUradora(),
                    'kandora' => $round->getTsumo()?->getKandora(),
                    'kanuradora' => $round->getTsumo()?->getKanuradora(),
                    'open_hand' => $round->getTsumo()?->getOpenHand(),
                ],
                'draw' => [
                    'outcome' => 'draw',
                    'round_index' => $round->getDraw()?->getRoundIndex(),
                    'honba' => $round->getDraw()?->getHonba(),
                    'riichi_bets' => implode(',', self::_toArray($round->getDraw()?->getRiichiBets())),
                    'riichi' => implode(',', self::_toArray($round->getDraw()?->getRiichiBets())),
                    'tempai' => implode(',', self::_toArray($round->getDraw()?->getTempai())),
                ],
                'abort' => [
                    'outcome' => 'abort',
                    'round_index' => $round->getAbort()?->getRoundIndex(),
                    'honba' => $round->getAbort()?->getHonba(),
                    'riichi' => implode(',', self::_toArray($round->getAbort()?->getRiichiBets())),
                    'riichi_bets' => implode(',', self::_toArray($round->getAbort()?->getRiichiBets())),
                ],
                'chombo' => [
                    'outcome' => 'chombo',
                    'round_index' => $round->getChombo()?->getRoundIndex(),
                    'honba' => $round->getChombo()?->getHonba(),
                    'loser_id' => $round->getChombo()?->getLoserId(),
                ],
                'nagashi' => [
                    'outcome' => 'nagashi',
                    'round_index' => $round->getNagashi()?->getRoundIndex(),
                    'honba' => $round->getNagashi()?->getHonba(),
                    'riichi_bets' => implode(',', self::_toArray($round->getNagashi()?->getRiichiBets())),
                    'riichi' => implode(',', self::_toArray($round->getNagashi()?->getRiichiBets())),
                    'tempai' => implode(',', self::_toArray($round->getNagashi()?->getTempai())),
                    'nagashi' => implode(',', self::_toArray($round->getNagashi()?->getNagashi())),
                ],
                default => throw new TwirpError('500', 'Unsupported outcome'),
            };
        }, $rounds);
    }

    /**
     * @param array $games
     * @return GameResult[]
     * @throws TwirpError
     */
    protected static function _formatGames(array $games): array
    {
        return array_map(function ($game) {
            return (new GameResult())
                ->setSessionHash($game['hash'])
                ->setDate($game['date'])
                ->setReplayLink($game['replay_link'])
                ->setPlayers($game['players'])
                ->setPenaltyLogs(self::_toPenaltiesLog($game['penalties']))
                ->setFinalResults(array_map(function ($result) {
                    return (new FinalResultOfSession())
                        ->setPlayerId($result['player_id'])
                        ->setScore($result['score'])
                        ->setRatingDelta($result['rating_delta'])
                        ->setPlace($result['place']);
                }, $game['final_results']))
                ->setRounds(array_map(function ($r) {
                    return self::_formatRound($r);
                }, $game['rounds']));
        }, $games);
    }

    public function GetRulesets(array $ctx, EventsGetRulesetsPayload $req): EventsGetRulesetsResponse
    {
        $ret = $this->_eventsController->getRulesets();
        return (new EventsGetRulesetsResponse())
            ->setRulesetIds(array_map(function ($r) { return $r['id']; },  $ret))
            ->setRulesetTitles(array_map(function ($r) { return $r['description']; },  $ret))
            ->setRulesets(array_map(function ($r) { return $r['originalRules']; },  $ret));
    }

    /**
     * @throws Exception
     */
    public function GetTimezones(array $ctx, EventsGetTimezonesPayload $req): EventsGetTimezonesResponse
    {
        $ret = $this->_eventsController->getTimezones($req->getAddr());
        return (new EventsGetTimezonesResponse())
            ->setTimezones($ret['timezones'])
            ->setPreferredByIp($ret['preferredByIp']);
    }

    /**
     * @throws Exception
     */
    public function GetCountries(array $ctx, EventsGetCountriesPayload $req): EventsGetCountriesResponse
    {
        $ret = $this->_eventsController->getCountries($req->getAddr());
        return (new EventsGetCountriesResponse())
            ->setCountries(array_map(function ($country) {
                return (new Country())
                    ->setCode($country['code'])
                    ->setName($country['name']);
            }, $ret['countries']))
            ->setPreferredByIp($ret['preferredByIp']);
    }

    /**
     * @throws Exception
     */
    public function GetEvents(array $ctx, EventsGetEventsPayload $req): EventsGetEventsResponse
    {
        $ret = $this->_eventsController->getEvents($req->getLimit(), $req->getOffset(), $req->getFilterUnlisted());
        return (new EventsGetEventsResponse())
            ->setTotal($ret['total'])
            ->setEvents(array_map(function ($ev) {
                return (new Event())
                    ->setId($ev['id'])
                    ->setTitle($ev['title'])
                    ->setDescription($ev['description'])
                    ->setType(self::_toEventTypeEnum($ev['type']))
                    ->setFinished($ev['finished'])
                    ->setIsPrescripted($ev['prescripted'])
                    ->setIsListed($ev['isListed'])
                    ->setIsRatingShown($ev['isRatingShown'])
                    ->setTournamentStarted($ev['tournamentStarted']);
            }, $ret['events']));
    }

    /**
     * @throws Exception
     */
    public function GetEventsById(array $ctx, EventsGetEventsByIdPayload $req): EventsGetEventsByIdResponse
    {
        return (new EventsGetEventsByIdResponse())
            ->setEvents(array_map(function ($ev) {
                return (new Event())
                    ->setId($ev['id'])
                    ->setTitle($ev['title'])
                    ->setDescription($ev['description'])
                    ->setType(self::_toEventTypeEnum($ev['type']))
                    ->setFinished($ev['finished'])
                    ->setIsPrescripted($ev['prescripted'])
                    ->setIsListed($ev['isListed'])
                    ->setIsRatingShown($ev['isRatingShown'])
                    ->setTournamentStarted($ev['tournamentStarted']);
            }, $this->_eventsController->getEventsById(iterator_to_array($req->getIds()))));
    }

    /**
     * @throws Exception
     */
    public function GetMyEvents(array $ctx, PlayersGetMyEventsPayload $req): PlayersGetMyEventsResponse
    {
        return (new PlayersGetMyEventsResponse())
            ->setEvents(array_map(function ($ev) {
                return (new MyEvent())
                    ->setId($ev['id'])
                    ->setTitle($ev['title'])
                    ->setDescription($ev['description'])
                    ->setIsOnline($ev['isOnline']);
            }, $this->_playersController->getMyEvents()));
    }

    /**
     * @throws InvalidParametersException
     */
    public function GetGameConfig(array $ctx, GenericEventPayload $req): GameConfig
    {
        $ret = $this->_eventsController->getGameConfig($req->getEventId());

        $gc = (new GameConfig())
            ->setRulesetConfig($ret['ruleset'])
            ->setEventTitle($ret['eventTitle'])
            ->setEventDescription($ret['eventDescription'])
            ->setEventStatHost($ret['eventStatHost'])
            ->setUseTimer($ret['useTimer'])
            ->setUsePenalty($ret['usePenalty'])
            ->setTimezone($ret['timezone'])
            ->setIsOnline($ret['isOnline'])
            ->setIsTeam($ret['isTeam'])
            ->setAutoSeating($ret['autoSeating'])
            ->setSyncStart($ret['syncStart'])
            ->setSyncEnd($ret['syncEnd'])
            ->setSortByGames($ret['sortByGames'])
            ->setAllowPlayerAppend($ret['allowPlayerAppend'])
            ->setSeriesLength($ret['seriesLength'])
            ->setMinGamesCount($ret['minGamesCount'])
            ->setHideResults($ret['hideResults'])
            ->setHideAddReplayButton($ret['hideAddReplayButton'])
            ->setIsPrescripted($ret['isPrescripted'])
            ->setIsFinished($ret['isFinished']);
        if (!empty($ret['gameDuration'])) {
            $gc->setGameDuration($ret['gameDuration']);
        }
        if (!empty($ret['gamesStatus'])) {
            $gc->setGamesStatus(self::_toGamesStatus($ret['gamesStatus']));
        }
        return $gc;
    }

    /**
     * @throws InvalidParametersException
     */
    public function GetRatingTable(array $ctx, EventsGetRatingTablePayload $req): EventsGetRatingTableResponse
    {
        return (new EventsGetRatingTableResponse())
            ->setList(array_map(function ($player) {
                return (new PlayerInRating())
                    ->setId($player['id'])
                    ->setTitle($player['title'])
                    ->setRating($player['rating'])
                    ->setTenhouId($player['tenhou_id'])
                    ->setChips($player['chips'])
                    ->setWinnerZone($player['winner_zone'])
                    ->setAvgPlace($player['avg_place'])
                    ->setAvgScore($player['avg_score'])
                    ->setGamesPlayed($player['games_played']);
            }, $this->_eventsController->getRatingTable(
                iterator_to_array($req->getEventIdList()),
                $req->getOrderBy(),
                $req->getOrder(),
                $req->getWithPrefinished()
            )));
    }

    /**
     * @throws InvalidParametersException
     * @throws TwirpError
     */
    public function GetLastGames(array $ctx, EventsGetLastGamesPayload $req): EventsGetLastGamesResponse
    {
        $ret = $this->_eventsController->getLastGames(
            iterator_to_array($req->getEventIdList()),
            $req->getLimit(),
            $req->getOffset(),
            $req->getOrderBy(),
            $req->getOrder()
        );
        return (new EventsGetLastGamesResponse())
            ->setTotalGames($ret['total_games'])
            ->setPlayers(self::_toPlayers($ret['players']))
            ->setGames(self::_formatGames($ret['games']));
    }

    /**
     * @throws InvalidParametersException
     * @throws TwirpError
     */
    public function GetGame(array $ctx, EventsGetGamePayload $req): EventsGetGameResponse
    {
        $ret = $this->_eventsController->getGame($req->getSessionHash());
        return (new EventsGetGameResponse())
            ->setPlayers(self::_toPlayers($ret['players']))
            ->setGame(self::_formatGames($ret['games'])[0]);
    }

    /**
     * @throws InvalidParametersException
     */
    public function GetGamesSeries(array $ctx, GenericEventPayload $req): EventsGetGamesSeriesResponse
    {
        return (new EventsGetGamesSeriesResponse())
            ->setResults(array_map(function ($result) {
                return (new SeriesResult())
                    ->setPlayer(self::_toPlayers([$result['player']])[0])
                    ->setBestSeries(array_map(function ($place) {
                        return (new PlayerPlaceInSeries())
                            ->setSessionHash($place['hash'])
                            ->setPlace($place['place']);
                    }, $result['best_series']))
                    ->setBestSeriesScores($result['best_series_scores'])
                    ->setBestSeriesPlaces($result['best_series_places'])
                    ->setBestSeriesAvgPlace($result['best_series_avg_place'])
                    ->setCurrentSeries(array_map(function ($place) {
                        return (new PlayerPlaceInSeries())
                            ->setSessionHash($place['hash'])
                            ->setPlace($place['place']);
                    }, $result['current_series']))
                    ->setCurrentSeriesScores($result['current_series_scores'])
                    ->setCurrentSeriesPlaces($result['current_series_places'])
                    ->setCurrentSeriesAvgPlace($result['current_series_avg_place']);
            }, $this->_eventsController->getGamesSeries($req->getEventId())));
    }

    /**
     * @throws Exception
     */
    public function GetCurrentSessions(array $ctx, PlayersGetCurrentSessionsPayload $req): PlayersGetCurrentSessionsResponse
    {
        return (new PlayersGetCurrentSessionsResponse())
            ->setSessions(array_map(function ($session) {
                $sess = (new CurrentSession())
                    ->setSessionHash($session['hashcode'])
                    ->setStatus($session['status'])
                    ->setPlayers(array_map(function ($player) {
                        $reg = (new PlayerInSession())
                            ->setId($player['id'])
                            ->setTitle($player['title'])
                            ->setScore($player['score']);
                        $repl = self::_replacement($player);
                        if (!empty($repl)) {
                            $reg->setReplacedBy($repl);
                        }
                        return $reg;
                    }, $session['players']));
                if (!empty($session['table_index'])) {
                    $sess->setTableIndex($session['table_index']);
                }
                return $sess;
            }, $this->_playersController->getCurrentSessions(
                $req->getPlayerId(),
                $req->getEventId()
            )));
    }

    /**
     * @throws Exception
     */
    public function GetAllRegisteredPlayers(array $ctx, EventsGetAllRegisteredPlayersPayload $req): EventsGetAllRegisteredPlayersResponse
    {
        return (new EventsGetAllRegisteredPlayersResponse())
            ->setPlayers(self::_toRegisteredPlayers($this->_eventsController->getAllRegisteredPlayers(
                iterator_to_array($req->getEventIds())
            )));
    }

    /**
     * @throws InvalidParametersException
     */
    public function GetTimerState(array $ctx, GenericEventPayload $req): EventsGetTimerStateResponse
    {
        $ret = $this->_eventsController->getTimerState($req->getEventId());
        if (empty($ret)) {
            return new EventsGetTimerStateResponse(); // not using timer -> not setting fields
        }
        return (new EventsGetTimerStateResponse())
            ->setStarted($ret['started'])
            ->setFinished($ret['finished'])
            ->setTimeRemaining($ret['time_remaining'] ?? 0)
            ->setWaitingForTimer($ret['waiting_for_timer'])
            ->setHaveAutostart($ret['have_autostart'])
            ->setAutostartTimer($ret['autostart_timer']);
    }

    /**
     * @throws InvalidParametersException
     * @throws EntityNotFoundException
     */
    public function GetSessionOverview(array $ctx, GamesGetSessionOverviewPayload $req): GamesGetSessionOverviewResponse
    {
        $ret = $this->_gamesController->getSessionOverview($req->getSessionHash());
        $overview = (new GamesGetSessionOverviewResponse())
            ->setId($ret['id'])
            ->setEventId($ret['event_id'])
            ->setPlayers(array_map(function ($player) {
                $reg = (new PlayerInSession())
                    ->setId($player['id'])
                    ->setTitle($player['title'])
                    ->setScore($player['score']);
                $repl = self::_replacement($player);
                if (!empty($repl)) {
                    $reg->setReplacedBy($repl);
                }
                return $reg;
            }, $ret['players']))
            ->setState((new \Common\SessionState())
                ->setDealer($ret['state']['dealer'])
                ->setRoundIndex($ret['state']['round'])
                ->setRiichiCount($ret['state']['riichi'])
                ->setHonbaCount($ret['state']['honba'])
                ->setScores(self::_makeScores($ret['state']['scores']))
                ->setFinished($ret['state']['finished'])
                ->setPenalties(self::_makePenalties($ret['state']['penalties']))
                ->setLastHandStarted($ret['state']['lastHandStarted']));
        if (!empty($ret['table_index'])) {
            $overview->setTableIndex($ret['table_index']);
        }
        return $overview;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function GetPlayerStats(array $ctx, PlayersGetPlayerStatsPayload $req): PlayersGetPlayerStatsResponse
    {
        $ret = $this->_playersController->getPlayerStats(
            $req->getPlayerId(),
            iterator_to_array($req->getEventIdList())
        );
        return (new PlayersGetPlayerStatsResponse())
            ->setRatingHistory($ret['rating_history'])
            ->setScoreHistory(array_map(function ($table) {
                return (new SessionHistoryResultTable())
                    ->setTables(self::_toResultsHistory($table));
            }, array_values($ret['score_history'])))
            ->setPlayersInfo(self::_toPlayers($ret['players_info']))
            ->setPlacesSummary(self::_toPlacesSummary($ret['places_summary']))
            ->setTotalPlayedGames($ret['total_played_games'])
            ->setTotalPlayedRounds($ret['total_played_rounds'])
            ->setWinSummary((new PlayerWinSummary())
                ->setRon($ret['win_summary']['ron'])
                ->setTsumo($ret['win_summary']['tsumo'])
                ->setChombo($ret['win_summary']['chombo'])
                ->setFeed($ret['win_summary']['feed'])
                ->setTsumofeed($ret['win_summary']['tsumofeed'])
                ->setWinsWithOpen($ret['win_summary']['wins_with_open'])
                ->setWinsWithRiichi($ret['win_summary']['wins_with_riichi'])
                ->setWinsWithDama($ret['win_summary']['wins_with_dama'])
                ->setUnforcedFeedToOpen($ret['win_summary']['unforced_feed_to_open'])
                ->setUnforcedFeedToRiichi($ret['win_summary']['unforced_feed_to_riichi'])
                ->setUnforcedFeedToDama($ret['win_summary']['unforced_feed_to_dama'])
                ->setDraw($ret['win_summary']['draw'])
                ->setDrawTempai($ret['win_summary']['draw_tempai'])
                ->setPointsWon($ret['win_summary']['points_won'])
                ->setPointsLostRon($ret['win_summary']['points_lost_ron'])
                ->setPointsLostTsumo($ret['win_summary']['points_lost_tsumo']))
            ->setHandsValueSummary(self::_toHandValueStat($ret['hands_value_summary']))
            ->setYakuSummary(self::_toYakuStat($ret['yaku_summary']))
            ->setRiichiSummary((new RiichiSummary())
                ->setRiichiWon($ret['riichi_summary']['riichi_won'])
                ->setRiichiLost($ret['riichi_summary']['riichi_lost'])
                ->setFeedUnderRiichi($ret['riichi_summary']['feed_under_riichi']))
            ->setDoraStat((new DoraSummary())
                ->setCount($ret['dora_stat']['count'])
                ->setAverage($ret['dora_stat']['average']));
    }

    /**
     * @throws BadActionException
     * @throws TwirpError
     */
    public function AddRound(array $ctx, GamesAddRoundPayload $req): GamesAddRoundResponse
    {
        $ret = $this->_gamesController->addRound(
            $req->getSessionHash(),
            empty($req->getRoundData()) ? [] : self::_toPlainRoundData([$req->getRoundData()])[0]
        );
        if (!is_array($ret)) {
            throw new InvalidParametersException();
        }
        return (new GamesAddRoundResponse())
            ->setScores(self::_makeScores($ret['_scores']))
            ->setExtraPenaltyLogs(self::_toPenaltiesLog($ret['_extraPenaltyLog']))
            ->setRound($ret['_round'])
            ->setHonba($ret['_honba'])
            ->setRiichiBets($ret['_riichiBets'])
            ->setPrematurelyFinished($ret['_prematurelyFinished'])
            ->setRoundJustChanged($ret['_roundJustChanged'])
            ->setLastHandStarted($ret['_lastHandStarted'])
            ->setLastOutcome(self::_toOutcome($ret['_lastOutcome']))
            ->setIsFinished($ret['_isFinished']);
    }

    /**
     * @throws TwirpError
     * @throws BadActionException
     */
    public function PreviewRound(array $ctx, GamesPreviewRoundPayload $req): GamesPreviewRoundResponse
    {
        $ret = $this->_gamesController->addRound(
            $req->getSessionHash(),
            empty($req->getRoundData()) ? [] : self::_toPlainRoundData([$req->getRoundData()])[0],
            true
        );
        if (!is_array($ret)) {
            throw new InvalidParametersException();
        }
        return (new GamesPreviewRoundResponse())
            ->setState(self::_toRoundState($ret));
    }

    /**
     * @throws InvalidParametersException
     * @throws TwirpError
     * @throws ParseException
     */
    public function AddOnlineReplay(array $ctx, GamesAddOnlineReplayPayload $req): GamesAddOnlineReplayResponse
    {
        $ret = $this->_gamesController->addOnlineReplay($req->getEventId(), $req->getLink());
        return (new GamesAddOnlineReplayResponse())
            ->setPlayers(self::_toPlayers($ret['players']))
            ->setGame(self::_formatGames($ret['games'])[0]);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function GetLastResults(array $ctx, PlayersGetLastResultsPayload $req): PlayersGetLastResultsResponse
    {
        $ret = $this->_playersController->getLastResults($req->getPlayerId(), $req->getEventId());
        return (new PlayersGetLastResultsResponse())
            ->setResults(empty($ret) ? [] : self::_toResultsHistory($ret));
    }

    /**
     * @throws Exception
     */
    public function GetLastRound(array $ctx, PlayersGetLastRoundPayload $req): PlayersGetLastRoundResponse
    {
        $ret = $this->_playersController->getLastRound($req->getPlayerId(), $req->getEventId());
        if (empty($ret)) {
            throw new InvalidParametersException();
        }
        return (new PlayersGetLastRoundResponse())
            ->setRound(self::_toRoundState($ret));
    }

    /**
     * @throws Exception
     */
    public function GetAllRounds(array $ctx, PlayersGetAllRoundsPayload $req): PlayersGetAllRoundsResponse
    {
        $ret = $this->_playersController->getAllRoundsByHash($req->getSessionHash());
        return (new PlayersGetAllRoundsResponse())
            /** @phpstan-ignore-next-line */
            ->setRounds(array_map('self::_toRoundState', $ret ?? []));
    }

    /**
     * @throws Exception
     */
    public function GetLastRoundByHash(array $ctx, PlayersGetLastRoundByHashPayload $req): PlayersGetLastRoundByHashResponse
    {
        $ret = $this->_playersController->getLastRoundByHashcode($req->getSessionHash());
        if (empty($ret)) {
            throw new InvalidParametersException();
        }
        return (new PlayersGetLastRoundByHashResponse())
            ->setRound(self::_toRoundState($ret));
    }

    /**
     * @throws InvalidParametersException
     * @throws BadActionException
     */
    public function GetEventForEdit(array $ctx, EventsGetEventForEditPayload $req): EventsGetEventForEditResponse
    {
        $ret = $this->_eventsController->getEventForEdit($req->getId());
        return (new EventsGetEventForEditResponse())
            ->setId($ret['id'])
            ->setEvent(self::_toEventData($ret));
    }

    /**
     * @throws BadActionException
     */
    public function RebuildScoring(array $ctx, GenericEventPayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_eventsController->rebuildEventScoring($req->getEventId()));
    }

    /**
     * @throws InvalidParametersException
     * @throws BadActionException
     */
    public function CreateEvent(array $ctx, EventData $req): GenericEventPayload
    {
        return (new GenericEventPayload())
            ->setEventId($this->_eventsController->createEvent(
                self::_fromEventTypeEnum($req->getType()),
                $req->getTitle(),
                $req->getDescription(),
                $req->getDuration(),
                $req->getTimezone(),
                $req->getSeriesLength(),
                $req->getMinGames(),
                $req->getLobbyId(),
                $req->getIsTeam(),
                $req->getIsPrescripted(),
                $req->getAutostart(),
                $req->getIsListed(),
                $req->getRulesetConfig(),
            ));
    }

    /**
     * @throws InvalidParametersException
     * @throws BadActionException
     */
    public function UpdateEvent(array $ctx, EventsUpdateEventPayload $req): GenericSuccessResponse
    {
        $ev = $req->getEvent();
        if (empty($ev)) {
            throw new InvalidParametersException();
        }
        return (new GenericSuccessResponse())
            ->setSuccess($this->_eventsController->updateEvent(
                $req->getId(),
                $ev->getTitle(),
                $ev->getDescription(),
                $ev->getDuration(),
                $ev->getTimezone(),
                $ev->getSeriesLength(),
                $ev->getMinGames(),
                $ev->getLobbyId(),
                $ev->getIsTeam(),
                $ev->getIsPrescripted(),
                $ev->getAutostart(),
                $ev->getIsListed(),
                $ev->getRulesetConfig(),
            ));
    }

    /**
     * @throws InvalidParametersException
     */
    public function FinishEvent(array $ctx, GenericEventPayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_eventsController->finishEvent($req->getEventId()));
    }

    /**
     * @throws InvalidParametersException
     */
    public function ToggleListed(array $ctx, GenericEventPayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_eventsController->toggleListed($req->getEventId()));
    }

    /**
     * @throws Exception
     */
    public function GetTablesState(array $ctx, GenericEventPayload $req): EventsGetTablesStateResponse
    {
        $ret = $this->_eventsController->getTablesState($req->getEventId());
        return (new EventsGetTablesStateResponse())
            ->setTables(array_map(function ($table) {
                $state = (new TableState())
                    ->setStatus(self::_toTableStatus($table['status']))
                    ->setMayDefinalize($table['may_definalize'])
                    ->setSessionHash($table['hash'])
                    ->setPenaltyLogs(self::_toPenaltiesLog($table['penalties']))
                    ->setCurrentRoundIndex($table['current_round'])
                    ->setScores(self::_makeScores($table['scores']))
                    ->setPlayers(self::_toRegisteredPlayers($table['players']));
                if (!empty($table['last_round_detailed'])) {
                    $state->setLastRound(self::_formatRound($table['last_round_detailed']));
                }
                if (!empty($table['table_index'])) {
                    $state->setTableIndex($table['table_index']);
                }
                return $state;
            }, $ret));
    }

    /**
     * @throws InvalidParametersException
     */
    public function StartTimer(array $ctx, GenericEventPayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_eventsController->startTimer($req->getEventId()));
    }

    /**
     * @throws InvalidParametersException
     */
    public function RegisterPlayer(array $ctx, EventsRegisterPlayerPayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_eventsController->registerPlayerAdmin(
                $req->getPlayerId(),
                $req->getEventId()
            ));
    }

    /**
     * @throws Exception
     */
    public function UnregisterPlayer(array $ctx, EventsUnregisterPlayerPayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_eventsController->unregisterPlayerAdmin(
                $req->getPlayerId(),
                $req->getEventId()
            ));
    }

    /**
     * @throws Exception
     */
    public function UpdatePlayerSeatingFlag(array $ctx, EventsUpdatePlayerSeatingFlagPayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_eventsController->updatePlayerSeatingFlag(
                $req->getPlayerId(),
                $req->getEventId(),
                $req->getIgnoreSeating() ? 1 : 0
            ));
    }

    /**
     * @throws InvalidParametersException
     */
    public function GetAchievements(array $ctx, EventsGetAchievementsPayload $req): EventsGetAchievementsResponse
    {
        $ret = $this->_eventsController->getAchievements(
            $req->getEventId(),
            iterator_to_array($req->getAchievementsList())
        );
        return (new EventsGetAchievementsResponse())
            ->setAchievements(array_map(function ($id, $ach) {
                return (new Achievement())
                    ->setAchievementId($id)
                    ->setAchievementData(json_encode($ach) ?: '');
            }, array_keys($ret), array_values($ret)));
    }

    /**
     * @throws InvalidParametersException
     */
    public function ToggleHideResults(array $ctx, GenericEventPayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_eventsController->toggleHideResults($req->getEventId()));
    }

    /**
     * @throws AuthFailedException
     */
    public function UpdatePlayersLocalIds(array $ctx, EventsUpdatePlayersLocalIdsPayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_eventsController->updateLocalIds(
                $req->getEventId(),
                array_reduce(iterator_to_array($req->getIdsToLocalIds()), function ($acc, LocalIdMapping $val) {
                    $acc[$val->getPlayerId()] = $val->getLocalId();
                    return $acc;
                }, [])
            ));
    }

    /**
     * @throws Exception
     */
    public function UpdatePlayerReplacement(array $ctx, EventsUpdatePlayerReplacementPayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_eventsController->updatePlayerReplacement(
                $req->getPlayerId(),
                $req->getEventId(),
                $req->getReplacementId()
            ));
    }

    /**
     * @throws AuthFailedException
     */
    public function UpdatePlayersTeams(array $ctx, EventsUpdatePlayersTeamsPayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_eventsController->updateTeamNames(
                $req->getEventId(),
                array_reduce(iterator_to_array($req->getIdsToTeamNames()), function ($acc, TeamMapping $val) {
                    $acc[$val->getPlayerId()] = $val->getTeamName();
                    return $acc;
                }, [])
            ));
    }

    /**
     * @throws InvalidUserException
     * @throws DatabaseException
     */
    public function StartGame(array $ctx, GamesStartGamePayload $req): GamesStartGameResponse
    {
        return (new GamesStartGameResponse())
            ->setSessionHash($this->_gamesController->start(
                $req->getEventId(),
                iterator_to_array($req->getPlayers())
            ));
    }

    /**
     * @throws Exception
     */
    public function EndGame(array $ctx, GamesEndGamePayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_gamesController->end($req->getSessionHash()));
    }

    /**
     * @throws Exception
     */
    public function CancelGame(array $ctx, GamesCancelGamePayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_gamesController->cancel($req->getSessionHash()));
    }

    /**
     * @throws Exception
     */
    public function FinalizeSession(array $ctx, GenericEventPayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_gamesController->finalizeSessions($req->getEventId()));
    }

    /**
     * @throws Exception
     */
    public function DropLastRound(array $ctx, GamesDropLastRoundPayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_gamesController->dropLastRound(
                $req->getSessionHash(),
                iterator_to_array($req->getIntermediateResults())
            ));
    }

    /**
     * @throws Exception
     */
    public function DefinalizeGame(array $ctx, GamesDefinalizeGamePayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_gamesController->definalizeGame($req->getSessionHash()));
    }

    /**
     * @throws Exception
     */
    public function AddPenalty(array $ctx, GamesAddPenaltyPayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_gamesController->addPenalty(
                $req->getEventId(),
                $req->getPlayerId(),
                $req->getAmount(),
                $req->getReason()
            ));
    }

    /**
     * @throws DatabaseException
     * @throws InvalidUserException
     */
    public function AddPenaltyGame(array $ctx, GamesAddPenaltyGamePayload $req): GamesAddPenaltyGameResponse
    {
        return (new GamesAddPenaltyGameResponse())
            ->setHash($this->_gamesController->addPenaltyGame(
                $req->getEventId(),
                iterator_to_array($req->getPlayers())
            ));
    }

    /**
     * @throws EntityNotFoundException
     */
    public function GetPlayer(array $ctx, PlayersGetPlayerPayload $req): PlayersGetPlayerResponse
    {
        return (new PlayersGetPlayerResponse())
            ->setPlayers(
                self::_toPlayers([$this->_playersController->get($req->getId())])[0]
            );
    }

    /**
     * @throws InvalidParametersException
     */
    public function GetCurrentSeating(array $ctx, GenericEventPayload $req): EventsGetCurrentSeatingResponse
    {
        $ret = $this->_eventsController->getCurrentSeating($req->getEventId());
        return (new EventsGetCurrentSeatingResponse())
            ->setSeating(array_map(function ($seat) {
                return (new PlayerSeating())
                    ->setPlayerId($seat['player_id'])
                    ->setTableIndex($seat['table_index'])
                    ->setRating((float)$seat['rating'])
                    ->setOrder($seat['order'])
                    ->setPlayerTitle($seat['title'])
                    ->setSessionId($seat['session_id']);
            }, $ret));
    }

    /**
     * @throws AuthFailedException
     * @throws InvalidParametersException
     */
    public function MakeShuffledSeating(array $ctx, SeatingMakeShuffledSeatingPayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_seatingController->makeShuffledSeating(
                $req->getEventId(),
                $req->getGroupsCount(),
                $req->getSeed()
            ));
    }

    /**
     * @throws InvalidParametersException
     * @throws AuthFailedException
     */
    public function MakeSwissSeating(array $ctx, GenericEventPayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_seatingController->makeSwissSeating($req->getEventId()));
    }

    /**
     * @throws Exception
     */
    public function ResetSeating(array $ctx, GenericEventPayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_seatingController->resetSeating($req->getEventId()));
    }

    /**
     * @throws AuthFailedException
     * @throws InvalidParametersException
     */
    public function GenerateSwissSeating(array $ctx, GenericEventPayload $req): SeatingGenerateSwissSeatingResponse
    {
        return (new SeatingGenerateSwissSeatingResponse())
            ->setTables(array_map(function ($table) {
                return (new TableItemSwiss())
                    ->setPlayers(array_map(function ($player, $rating) {
                        return (new PlayerSeatingSwiss())
                            ->setPlayerId((int)$player)
                            ->setRating((float)$rating);
                    }, array_keys($table), array_values($table)));
            }, $this->_seatingController->generateSwissSeating($req->getEventId())));
    }

    /**
     * @throws DatabaseException
     * @throws AuthFailedException
     * @throws InvalidParametersException
     * @throws InvalidUserException
     */
    public function MakeIntervalSeating(array $ctx, SeatingMakeIntervalSeatingPayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_seatingController->makeIntervalSeating(
                $req->getEventId(),
                $req->getStep()
            ));
    }

    /**
     * @throws DatabaseException
     * @throws InvalidParametersException
     * @throws AuthFailedException
     * @throws InvalidUserException
     */
    public function MakePrescriptedSeating(array $ctx, SeatingMakePrescriptedSeatingPayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_seatingController->makePrescriptedSeating(
                $req->getEventId(),
                $req->getRandomizeAtTables()
            ));
    }

    /**
     * @throws AuthFailedException
     * @throws InvalidParametersException
     */
    public function GetNextPrescriptedSeating(array $ctx, GenericEventPayload $req): SeatingGetNextPrescriptedSeatingResponse
    {
        return (new SeatingGetNextPrescriptedSeatingResponse())
            ->setTables(array_map(function ($table) {
                return (new PrescriptedTable())
                    ->setPlayers(self::_toRegisteredPlayers($table));
            }, $this->_seatingController->getNextSeatingForPrescriptedEvent($req->getEventId())));
    }

    /**
     * @throws InvalidParametersException
     */
    public function GetPrescriptedEventConfig(array $ctx, GenericEventPayload $req): EventsGetPrescriptedEventConfigResponse
    {
        $ret = $this->_eventsController->getPrescriptedEventConfig($req->getEventId());
        return (new EventsGetPrescriptedEventConfigResponse())
            ->setEventId($ret['event_id'])
            ->setNextSessionIndex($ret['next_session_index'])
            ->setPrescript($ret['prescript'])
            ->setErrors($ret['check_errors']);
    }

    /**
     * @throws InvalidParametersException
     */
    public function UpdatePrescriptedEventConfig(array $ctx, EventsUpdatePrescriptedEventConfigPayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_eventsController->updatePrescriptedEventConfig(
                $req->getEventId(),
                $req->getNextSessionIndex(),
                $req->getPrescript()
            ));
    }

    /**
     * @throws InvalidParametersException
     * @throws BadActionException
     */
    public function InitStartingTimer(array $ctx, GenericEventPayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_eventsController->initStartingTimer($req->getEventId()));
    }

    /**
     * @throws InvalidParametersException
     */
    public function GetStartingTimer(array $ctx, GenericEventPayload $req): EventsGetStartingTimerResponse
    {
        return (new EventsGetStartingTimerResponse())
            ->setTimer($this->_eventsController->getStartingTimer($req->getEventId()));
    }

    public function AddErrorLog(array $ctx, MiscAddErrorLogPayload $req): GenericSuccessResponse
    {
        return (new GenericSuccessResponse())
            ->setSuccess($this->_miscController->addErrorLog(
                $req->getFacility(),
                $req->getSessionHash(),
                $req->getPlayerId(),
                $req->getError(),
                $req->getStack()
            ));
    }
}

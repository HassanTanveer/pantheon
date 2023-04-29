<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/atoms.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.GameConfig</code>
 */
class GameConfig extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string rulesetTitle = 10;</code>
     */
    protected $rulesetTitle = '';
    /**
     * Generated from protobuf field <code>string eventTitle = 26;</code>
     */
    protected $eventTitle = '';
    /**
     * Generated from protobuf field <code>string eventDescription = 27;</code>
     */
    protected $eventDescription = '';
    /**
     * Generated from protobuf field <code>string eventStatHost = 28;</code>
     */
    protected $eventStatHost = '';
    /**
     * Generated from protobuf field <code>bool useTimer = 29;</code>
     */
    protected $useTimer = false;
    /**
     * Generated from protobuf field <code>bool usePenalty = 30;</code>
     */
    protected $usePenalty = false;
    /**
     * minutes
     *
     * Generated from protobuf field <code>int32 gameDuration = 34;</code>
     */
    protected $gameDuration = 0;
    /**
     * Generated from protobuf field <code>string timezone = 35;</code>
     */
    protected $timezone = '';
    /**
     * Generated from protobuf field <code>bool isOnline = 36;</code>
     */
    protected $isOnline = false;
    /**
     * Generated from protobuf field <code>bool isTeam = 37;</code>
     */
    protected $isTeam = false;
    /**
     * Generated from protobuf field <code>bool autoSeating = 38;</code>
     */
    protected $autoSeating = false;
    /**
     * Generated from protobuf field <code>bool syncStart = 39;</code>
     */
    protected $syncStart = false;
    /**
     * Generated from protobuf field <code>bool syncEnd = 40;</code>
     */
    protected $syncEnd = false;
    /**
     * Generated from protobuf field <code>bool sortByGames = 41;</code>
     */
    protected $sortByGames = false;
    /**
     * Generated from protobuf field <code>bool allowPlayerAppend = 42;</code>
     */
    protected $allowPlayerAppend = false;
    /**
     * Generated from protobuf field <code>int32 seriesLength = 45;</code>
     */
    protected $seriesLength = 0;
    /**
     * Generated from protobuf field <code>int32 minGamesCount = 46;</code>
     */
    protected $minGamesCount = 0;
    /**
     * Generated from protobuf field <code>.Common.TournamentGamesStatus gamesStatus = 47;</code>
     */
    protected $gamesStatus = 0;
    /**
     * Generated from protobuf field <code>bool hideResults = 48;</code>
     */
    protected $hideResults = false;
    /**
     * Generated from protobuf field <code>bool hideAddReplayButton = 49;</code>
     */
    protected $hideAddReplayButton = false;
    /**
     * Generated from protobuf field <code>bool isPrescripted = 50;</code>
     */
    protected $isPrescripted = false;
    /**
     * Generated from protobuf field <code>bool isFinished = 52;</code>
     */
    protected $isFinished = false;
    /**
     * Generated from protobuf field <code>.Common.RulesetConfig rulesetConfig = 53;</code>
     */
    protected $rulesetConfig = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $rulesetTitle
     *     @type string $eventTitle
     *     @type string $eventDescription
     *     @type string $eventStatHost
     *     @type bool $useTimer
     *     @type bool $usePenalty
     *     @type int $gameDuration
     *           minutes
     *     @type string $timezone
     *     @type bool $isOnline
     *     @type bool $isTeam
     *     @type bool $autoSeating
     *     @type bool $syncStart
     *     @type bool $syncEnd
     *     @type bool $sortByGames
     *     @type bool $allowPlayerAppend
     *     @type int $seriesLength
     *     @type int $minGamesCount
     *     @type int $gamesStatus
     *     @type bool $hideResults
     *     @type bool $hideAddReplayButton
     *     @type bool $isPrescripted
     *     @type bool $isFinished
     *     @type \Common\RulesetConfig $rulesetConfig
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Proto\Atoms::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string rulesetTitle = 10;</code>
     * @return string
     */
    public function getRulesetTitle()
    {
        return $this->rulesetTitle;
    }

    /**
     * Generated from protobuf field <code>string rulesetTitle = 10;</code>
     * @param string $var
     * @return $this
     */
    public function setRulesetTitle($var)
    {
        GPBUtil::checkString($var, True);
        $this->rulesetTitle = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string eventTitle = 26;</code>
     * @return string
     */
    public function getEventTitle()
    {
        return $this->eventTitle;
    }

    /**
     * Generated from protobuf field <code>string eventTitle = 26;</code>
     * @param string $var
     * @return $this
     */
    public function setEventTitle($var)
    {
        GPBUtil::checkString($var, True);
        $this->eventTitle = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string eventDescription = 27;</code>
     * @return string
     */
    public function getEventDescription()
    {
        return $this->eventDescription;
    }

    /**
     * Generated from protobuf field <code>string eventDescription = 27;</code>
     * @param string $var
     * @return $this
     */
    public function setEventDescription($var)
    {
        GPBUtil::checkString($var, True);
        $this->eventDescription = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string eventStatHost = 28;</code>
     * @return string
     */
    public function getEventStatHost()
    {
        return $this->eventStatHost;
    }

    /**
     * Generated from protobuf field <code>string eventStatHost = 28;</code>
     * @param string $var
     * @return $this
     */
    public function setEventStatHost($var)
    {
        GPBUtil::checkString($var, True);
        $this->eventStatHost = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool useTimer = 29;</code>
     * @return bool
     */
    public function getUseTimer()
    {
        return $this->useTimer;
    }

    /**
     * Generated from protobuf field <code>bool useTimer = 29;</code>
     * @param bool $var
     * @return $this
     */
    public function setUseTimer($var)
    {
        GPBUtil::checkBool($var);
        $this->useTimer = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool usePenalty = 30;</code>
     * @return bool
     */
    public function getUsePenalty()
    {
        return $this->usePenalty;
    }

    /**
     * Generated from protobuf field <code>bool usePenalty = 30;</code>
     * @param bool $var
     * @return $this
     */
    public function setUsePenalty($var)
    {
        GPBUtil::checkBool($var);
        $this->usePenalty = $var;

        return $this;
    }

    /**
     * minutes
     *
     * Generated from protobuf field <code>int32 gameDuration = 34;</code>
     * @return int
     */
    public function getGameDuration()
    {
        return $this->gameDuration;
    }

    /**
     * minutes
     *
     * Generated from protobuf field <code>int32 gameDuration = 34;</code>
     * @param int $var
     * @return $this
     */
    public function setGameDuration($var)
    {
        GPBUtil::checkInt32($var);
        $this->gameDuration = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string timezone = 35;</code>
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Generated from protobuf field <code>string timezone = 35;</code>
     * @param string $var
     * @return $this
     */
    public function setTimezone($var)
    {
        GPBUtil::checkString($var, True);
        $this->timezone = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool isOnline = 36;</code>
     * @return bool
     */
    public function getIsOnline()
    {
        return $this->isOnline;
    }

    /**
     * Generated from protobuf field <code>bool isOnline = 36;</code>
     * @param bool $var
     * @return $this
     */
    public function setIsOnline($var)
    {
        GPBUtil::checkBool($var);
        $this->isOnline = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool isTeam = 37;</code>
     * @return bool
     */
    public function getIsTeam()
    {
        return $this->isTeam;
    }

    /**
     * Generated from protobuf field <code>bool isTeam = 37;</code>
     * @param bool $var
     * @return $this
     */
    public function setIsTeam($var)
    {
        GPBUtil::checkBool($var);
        $this->isTeam = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool autoSeating = 38;</code>
     * @return bool
     */
    public function getAutoSeating()
    {
        return $this->autoSeating;
    }

    /**
     * Generated from protobuf field <code>bool autoSeating = 38;</code>
     * @param bool $var
     * @return $this
     */
    public function setAutoSeating($var)
    {
        GPBUtil::checkBool($var);
        $this->autoSeating = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool syncStart = 39;</code>
     * @return bool
     */
    public function getSyncStart()
    {
        return $this->syncStart;
    }

    /**
     * Generated from protobuf field <code>bool syncStart = 39;</code>
     * @param bool $var
     * @return $this
     */
    public function setSyncStart($var)
    {
        GPBUtil::checkBool($var);
        $this->syncStart = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool syncEnd = 40;</code>
     * @return bool
     */
    public function getSyncEnd()
    {
        return $this->syncEnd;
    }

    /**
     * Generated from protobuf field <code>bool syncEnd = 40;</code>
     * @param bool $var
     * @return $this
     */
    public function setSyncEnd($var)
    {
        GPBUtil::checkBool($var);
        $this->syncEnd = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool sortByGames = 41;</code>
     * @return bool
     */
    public function getSortByGames()
    {
        return $this->sortByGames;
    }

    /**
     * Generated from protobuf field <code>bool sortByGames = 41;</code>
     * @param bool $var
     * @return $this
     */
    public function setSortByGames($var)
    {
        GPBUtil::checkBool($var);
        $this->sortByGames = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool allowPlayerAppend = 42;</code>
     * @return bool
     */
    public function getAllowPlayerAppend()
    {
        return $this->allowPlayerAppend;
    }

    /**
     * Generated from protobuf field <code>bool allowPlayerAppend = 42;</code>
     * @param bool $var
     * @return $this
     */
    public function setAllowPlayerAppend($var)
    {
        GPBUtil::checkBool($var);
        $this->allowPlayerAppend = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 seriesLength = 45;</code>
     * @return int
     */
    public function getSeriesLength()
    {
        return $this->seriesLength;
    }

    /**
     * Generated from protobuf field <code>int32 seriesLength = 45;</code>
     * @param int $var
     * @return $this
     */
    public function setSeriesLength($var)
    {
        GPBUtil::checkInt32($var);
        $this->seriesLength = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 minGamesCount = 46;</code>
     * @return int
     */
    public function getMinGamesCount()
    {
        return $this->minGamesCount;
    }

    /**
     * Generated from protobuf field <code>int32 minGamesCount = 46;</code>
     * @param int $var
     * @return $this
     */
    public function setMinGamesCount($var)
    {
        GPBUtil::checkInt32($var);
        $this->minGamesCount = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.Common.TournamentGamesStatus gamesStatus = 47;</code>
     * @return int
     */
    public function getGamesStatus()
    {
        return $this->gamesStatus;
    }

    /**
     * Generated from protobuf field <code>.Common.TournamentGamesStatus gamesStatus = 47;</code>
     * @param int $var
     * @return $this
     */
    public function setGamesStatus($var)
    {
        GPBUtil::checkEnum($var, \Common\TournamentGamesStatus::class);
        $this->gamesStatus = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool hideResults = 48;</code>
     * @return bool
     */
    public function getHideResults()
    {
        return $this->hideResults;
    }

    /**
     * Generated from protobuf field <code>bool hideResults = 48;</code>
     * @param bool $var
     * @return $this
     */
    public function setHideResults($var)
    {
        GPBUtil::checkBool($var);
        $this->hideResults = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool hideAddReplayButton = 49;</code>
     * @return bool
     */
    public function getHideAddReplayButton()
    {
        return $this->hideAddReplayButton;
    }

    /**
     * Generated from protobuf field <code>bool hideAddReplayButton = 49;</code>
     * @param bool $var
     * @return $this
     */
    public function setHideAddReplayButton($var)
    {
        GPBUtil::checkBool($var);
        $this->hideAddReplayButton = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool isPrescripted = 50;</code>
     * @return bool
     */
    public function getIsPrescripted()
    {
        return $this->isPrescripted;
    }

    /**
     * Generated from protobuf field <code>bool isPrescripted = 50;</code>
     * @param bool $var
     * @return $this
     */
    public function setIsPrescripted($var)
    {
        GPBUtil::checkBool($var);
        $this->isPrescripted = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool isFinished = 52;</code>
     * @return bool
     */
    public function getIsFinished()
    {
        return $this->isFinished;
    }

    /**
     * Generated from protobuf field <code>bool isFinished = 52;</code>
     * @param bool $var
     * @return $this
     */
    public function setIsFinished($var)
    {
        GPBUtil::checkBool($var);
        $this->isFinished = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.Common.RulesetConfig rulesetConfig = 53;</code>
     * @return \Common\RulesetConfig|null
     */
    public function getRulesetConfig()
    {
        return $this->rulesetConfig;
    }

    public function hasRulesetConfig()
    {
        return isset($this->rulesetConfig);
    }

    public function clearRulesetConfig()
    {
        unset($this->rulesetConfig);
    }

    /**
     * Generated from protobuf field <code>.Common.RulesetConfig rulesetConfig = 53;</code>
     * @param \Common\RulesetConfig $var
     * @return $this
     */
    public function setRulesetConfig($var)
    {
        GPBUtil::checkMessage($var, \Common\RulesetConfig::class);
        $this->rulesetConfig = $var;

        return $this;
    }

}


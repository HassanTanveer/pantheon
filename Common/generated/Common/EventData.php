<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/atoms.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.EventData</code>
 */
class EventData extends \Google\Protobuf\Internal\Message
{
    /**
     * required to add, not required for edit
     *
     * Generated from protobuf field <code>optional .Common.EventType type = 1;</code>
     */
    protected $type = null;
    /**
     * Generated from protobuf field <code>string title = 2;</code>
     */
    protected $title = '';
    /**
     * Generated from protobuf field <code>string description = 3;</code>
     */
    protected $description = '';
    /**
     * Generated from protobuf field <code>int32 duration = 4;</code>
     */
    protected $duration = 0;
    /**
     * Generated from protobuf field <code>string timezone = 6;</code>
     */
    protected $timezone = '';
    /**
     * xxxx for common lobby, 1xxxx for tournament lobby
     *
     * Generated from protobuf field <code>int32 lobbyId = 7;</code>
     */
    protected $lobbyId = 0;
    /**
     * Generated from protobuf field <code>int32 seriesLength = 8;</code>
     */
    protected $seriesLength = 0;
    /**
     * Generated from protobuf field <code>int32 minGames = 9;</code>
     */
    protected $minGames = 0;
    /**
     * Generated from protobuf field <code>bool isTeam = 10;</code>
     */
    protected $isTeam = false;
    /**
     * Generated from protobuf field <code>bool isPrescripted = 11;</code>
     */
    protected $isPrescripted = false;
    /**
     * time until game autostart
     *
     * Generated from protobuf field <code>int32 autostart = 12;</code>
     */
    protected $autostart = 0;
    /**
     * Generated from protobuf field <code>.Common.RulesetConfig rulesetConfig = 14;</code>
     */
    protected $rulesetConfig = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $type
     *           required to add, not required for edit
     *     @type string $title
     *     @type string $description
     *     @type int $duration
     *     @type string $timezone
     *     @type int $lobbyId
     *           xxxx for common lobby, 1xxxx for tournament lobby
     *     @type int $seriesLength
     *     @type int $minGames
     *     @type bool $isTeam
     *     @type bool $isPrescripted
     *     @type int $autostart
     *           time until game autostart
     *     @type \Common\RulesetConfig $rulesetConfig
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Proto\Atoms::initOnce();
        parent::__construct($data);
    }

    /**
     * required to add, not required for edit
     *
     * Generated from protobuf field <code>optional .Common.EventType type = 1;</code>
     * @return int
     */
    public function getType()
    {
        return isset($this->type) ? $this->type : 0;
    }

    public function hasType()
    {
        return isset($this->type);
    }

    public function clearType()
    {
        unset($this->type);
    }

    /**
     * required to add, not required for edit
     *
     * Generated from protobuf field <code>optional .Common.EventType type = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setType($var)
    {
        GPBUtil::checkEnum($var, \Common\EventType::class);
        $this->type = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string title = 2;</code>
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Generated from protobuf field <code>string title = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setTitle($var)
    {
        GPBUtil::checkString($var, True);
        $this->title = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string description = 3;</code>
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Generated from protobuf field <code>string description = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setDescription($var)
    {
        GPBUtil::checkString($var, True);
        $this->description = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 duration = 4;</code>
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Generated from protobuf field <code>int32 duration = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setDuration($var)
    {
        GPBUtil::checkInt32($var);
        $this->duration = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string timezone = 6;</code>
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Generated from protobuf field <code>string timezone = 6;</code>
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
     * xxxx for common lobby, 1xxxx for tournament lobby
     *
     * Generated from protobuf field <code>int32 lobbyId = 7;</code>
     * @return int
     */
    public function getLobbyId()
    {
        return $this->lobbyId;
    }

    /**
     * xxxx for common lobby, 1xxxx for tournament lobby
     *
     * Generated from protobuf field <code>int32 lobbyId = 7;</code>
     * @param int $var
     * @return $this
     */
    public function setLobbyId($var)
    {
        GPBUtil::checkInt32($var);
        $this->lobbyId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 seriesLength = 8;</code>
     * @return int
     */
    public function getSeriesLength()
    {
        return $this->seriesLength;
    }

    /**
     * Generated from protobuf field <code>int32 seriesLength = 8;</code>
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
     * Generated from protobuf field <code>int32 minGames = 9;</code>
     * @return int
     */
    public function getMinGames()
    {
        return $this->minGames;
    }

    /**
     * Generated from protobuf field <code>int32 minGames = 9;</code>
     * @param int $var
     * @return $this
     */
    public function setMinGames($var)
    {
        GPBUtil::checkInt32($var);
        $this->minGames = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool isTeam = 10;</code>
     * @return bool
     */
    public function getIsTeam()
    {
        return $this->isTeam;
    }

    /**
     * Generated from protobuf field <code>bool isTeam = 10;</code>
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
     * Generated from protobuf field <code>bool isPrescripted = 11;</code>
     * @return bool
     */
    public function getIsPrescripted()
    {
        return $this->isPrescripted;
    }

    /**
     * Generated from protobuf field <code>bool isPrescripted = 11;</code>
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
     * time until game autostart
     *
     * Generated from protobuf field <code>int32 autostart = 12;</code>
     * @return int
     */
    public function getAutostart()
    {
        return $this->autostart;
    }

    /**
     * time until game autostart
     *
     * Generated from protobuf field <code>int32 autostart = 12;</code>
     * @param int $var
     * @return $this
     */
    public function setAutostart($var)
    {
        GPBUtil::checkInt32($var);
        $this->autostart = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.Common.RulesetConfig rulesetConfig = 14;</code>
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
     * Generated from protobuf field <code>.Common.RulesetConfig rulesetConfig = 14;</code>
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


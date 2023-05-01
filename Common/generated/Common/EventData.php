<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/atoms.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>common.EventData</code>
 */
class EventData extends \Google\Protobuf\Internal\Message
{
    /**
     * required to add, not required for edit
     *
     * Generated from protobuf field <code>optional .common.EventType type = 1;</code>
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
     * Generated from protobuf field <code>int32 lobby_id = 7;</code>
     */
    protected $lobby_id = 0;
    /**
     * Generated from protobuf field <code>int32 series_length = 8;</code>
     */
    protected $series_length = 0;
    /**
     * Generated from protobuf field <code>int32 min_games = 9;</code>
     */
    protected $min_games = 0;
    /**
     * Generated from protobuf field <code>bool is_team = 10;</code>
     */
    protected $is_team = false;
    /**
     * Generated from protobuf field <code>bool is_prescripted = 11;</code>
     */
    protected $is_prescripted = false;
    /**
     * time until game autostart
     *
     * Generated from protobuf field <code>int32 autostart = 12;</code>
     */
    protected $autostart = 0;
    /**
     * Generated from protobuf field <code>.common.RulesetConfig ruleset_config = 14;</code>
     */
    protected $ruleset_config = null;

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
     *     @type int $lobby_id
     *           xxxx for common lobby, 1xxxx for tournament lobby
     *     @type int $series_length
     *     @type int $min_games
     *     @type bool $is_team
     *     @type bool $is_prescripted
     *     @type int $autostart
     *           time until game autostart
     *     @type \Common\RulesetConfig $ruleset_config
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Proto\Atoms::initOnce();
        parent::__construct($data);
    }

    /**
     * required to add, not required for edit
     *
     * Generated from protobuf field <code>optional .common.EventType type = 1;</code>
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
     * Generated from protobuf field <code>optional .common.EventType type = 1;</code>
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
     * Generated from protobuf field <code>int32 lobby_id = 7;</code>
     * @return int
     */
    public function getLobbyId()
    {
        return $this->lobby_id;
    }

    /**
     * xxxx for common lobby, 1xxxx for tournament lobby
     *
     * Generated from protobuf field <code>int32 lobby_id = 7;</code>
     * @param int $var
     * @return $this
     */
    public function setLobbyId($var)
    {
        GPBUtil::checkInt32($var);
        $this->lobby_id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 series_length = 8;</code>
     * @return int
     */
    public function getSeriesLength()
    {
        return $this->series_length;
    }

    /**
     * Generated from protobuf field <code>int32 series_length = 8;</code>
     * @param int $var
     * @return $this
     */
    public function setSeriesLength($var)
    {
        GPBUtil::checkInt32($var);
        $this->series_length = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 min_games = 9;</code>
     * @return int
     */
    public function getMinGames()
    {
        return $this->min_games;
    }

    /**
     * Generated from protobuf field <code>int32 min_games = 9;</code>
     * @param int $var
     * @return $this
     */
    public function setMinGames($var)
    {
        GPBUtil::checkInt32($var);
        $this->min_games = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool is_team = 10;</code>
     * @return bool
     */
    public function getIsTeam()
    {
        return $this->is_team;
    }

    /**
     * Generated from protobuf field <code>bool is_team = 10;</code>
     * @param bool $var
     * @return $this
     */
    public function setIsTeam($var)
    {
        GPBUtil::checkBool($var);
        $this->is_team = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool is_prescripted = 11;</code>
     * @return bool
     */
    public function getIsPrescripted()
    {
        return $this->is_prescripted;
    }

    /**
     * Generated from protobuf field <code>bool is_prescripted = 11;</code>
     * @param bool $var
     * @return $this
     */
    public function setIsPrescripted($var)
    {
        GPBUtil::checkBool($var);
        $this->is_prescripted = $var;

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
     * Generated from protobuf field <code>.common.RulesetConfig ruleset_config = 14;</code>
     * @return \Common\RulesetConfig|null
     */
    public function getRulesetConfig()
    {
        return $this->ruleset_config;
    }

    public function hasRulesetConfig()
    {
        return isset($this->ruleset_config);
    }

    public function clearRulesetConfig()
    {
        unset($this->ruleset_config);
    }

    /**
     * Generated from protobuf field <code>.common.RulesetConfig ruleset_config = 14;</code>
     * @param \Common\RulesetConfig $var
     * @return $this
     */
    public function setRulesetConfig($var)
    {
        GPBUtil::checkMessage($var, \Common\RulesetConfig::class);
        $this->ruleset_config = $var;

        return $this;
    }

}


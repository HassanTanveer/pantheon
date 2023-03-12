<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: mimir.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.Events_UpdatePlayersTeams_Payload</code>
 */
class Events_UpdatePlayersTeams_Payload extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 eventId = 1;</code>
     */
    protected $eventId = 0;
    /**
     * Generated from protobuf field <code>repeated .Common.TeamMapping teamNameMap = 2;</code>
     */
    private $teamNameMap;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $eventId
     *     @type array<\Common\TeamMapping>|\Google\Protobuf\Internal\RepeatedField $teamNameMap
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Mimir::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>int32 eventId = 1;</code>
     * @return int
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Generated from protobuf field <code>int32 eventId = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setEventId($var)
    {
        GPBUtil::checkInt32($var);
        $this->eventId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .Common.TeamMapping teamNameMap = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getTeamNameMap()
    {
        return $this->teamNameMap;
    }

    /**
     * Generated from protobuf field <code>repeated .Common.TeamMapping teamNameMap = 2;</code>
     * @param array<\Common\TeamMapping>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setTeamNameMap($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Common\TeamMapping::class);
        $this->teamNameMap = $arr;

        return $this;
    }

}


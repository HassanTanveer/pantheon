<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: mimir.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.Games_AddPenaltyGame_Payload</code>
 */
class Games_AddPenaltyGame_Payload extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 eventId = 1;</code>
     */
    protected $eventId = 0;
    /**
     * ids, e-s-w-n
     *
     * Generated from protobuf field <code>repeated int32 players = 2;</code>
     */
    private $players;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $eventId
     *     @type array<int>|\Google\Protobuf\Internal\RepeatedField $players
     *           ids, e-s-w-n
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
     * ids, e-s-w-n
     *
     * Generated from protobuf field <code>repeated int32 players = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * ids, e-s-w-n
     *
     * Generated from protobuf field <code>repeated int32 players = 2;</code>
     * @param array<int>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setPlayers($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::INT32);
        $this->players = $arr;

        return $this;
    }

}


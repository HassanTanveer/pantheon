<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/mimir.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.Events_UpdatePlayerReplacement_Payload</code>
 */
class Events_UpdatePlayerReplacement_Payload extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 playerId = 1;</code>
     */
    protected $playerId = 0;
    /**
     * Generated from protobuf field <code>int32 eventId = 2;</code>
     */
    protected $eventId = 0;
    /**
     * Generated from protobuf field <code>int32 replacementId = 3;</code>
     */
    protected $replacementId = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $playerId
     *     @type int $eventId
     *     @type int $replacementId
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Proto\Mimir::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>int32 playerId = 1;</code>
     * @return int
     */
    public function getPlayerId()
    {
        return $this->playerId;
    }

    /**
     * Generated from protobuf field <code>int32 playerId = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setPlayerId($var)
    {
        GPBUtil::checkInt32($var);
        $this->playerId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 eventId = 2;</code>
     * @return int
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Generated from protobuf field <code>int32 eventId = 2;</code>
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
     * Generated from protobuf field <code>int32 replacementId = 3;</code>
     * @return int
     */
    public function getReplacementId()
    {
        return $this->replacementId;
    }

    /**
     * Generated from protobuf field <code>int32 replacementId = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setReplacementId($var)
    {
        GPBUtil::checkInt32($var);
        $this->replacementId = $var;

        return $this;
    }

}


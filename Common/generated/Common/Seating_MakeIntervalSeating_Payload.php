<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: mimir.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.Seating_MakeIntervalSeating_Payload</code>
 */
class Seating_MakeIntervalSeating_Payload extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 eventId = 1;</code>
     */
    protected $eventId = 0;
    /**
     * Generated from protobuf field <code>int32 step = 2;</code>
     */
    protected $step = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $eventId
     *     @type int $step
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
     * Generated from protobuf field <code>int32 step = 2;</code>
     * @return int
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * Generated from protobuf field <code>int32 step = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setStep($var)
    {
        GPBUtil::checkInt32($var);
        $this->step = $var;

        return $this;
    }

}


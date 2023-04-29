<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/atoms.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.SessionHistoryResult</code>
 */
class SessionHistoryResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string sessionHash = 1;</code>
     */
    protected $sessionHash = '';
    /**
     * Generated from protobuf field <code>int32 eventId = 2;</code>
     */
    protected $eventId = 0;
    /**
     * Generated from protobuf field <code>int32 playerId = 3;</code>
     */
    protected $playerId = 0;
    /**
     * Generated from protobuf field <code>int32 score = 4;</code>
     */
    protected $score = 0;
    /**
     * Generated from protobuf field <code>float ratingDelta = 5;</code>
     */
    protected $ratingDelta = 0.0;
    /**
     * Generated from protobuf field <code>int32 place = 6;</code>
     */
    protected $place = 0;
    /**
     * Generated from protobuf field <code>string title = 7;</code>
     */
    protected $title = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $sessionHash
     *     @type int $eventId
     *     @type int $playerId
     *     @type int $score
     *     @type float $ratingDelta
     *     @type int $place
     *     @type string $title
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Proto\Atoms::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string sessionHash = 1;</code>
     * @return string
     */
    public function getSessionHash()
    {
        return $this->sessionHash;
    }

    /**
     * Generated from protobuf field <code>string sessionHash = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setSessionHash($var)
    {
        GPBUtil::checkString($var, True);
        $this->sessionHash = $var;

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
     * Generated from protobuf field <code>int32 playerId = 3;</code>
     * @return int
     */
    public function getPlayerId()
    {
        return $this->playerId;
    }

    /**
     * Generated from protobuf field <code>int32 playerId = 3;</code>
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
     * Generated from protobuf field <code>int32 score = 4;</code>
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Generated from protobuf field <code>int32 score = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setScore($var)
    {
        GPBUtil::checkInt32($var);
        $this->score = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>float ratingDelta = 5;</code>
     * @return float
     */
    public function getRatingDelta()
    {
        return $this->ratingDelta;
    }

    /**
     * Generated from protobuf field <code>float ratingDelta = 5;</code>
     * @param float $var
     * @return $this
     */
    public function setRatingDelta($var)
    {
        GPBUtil::checkFloat($var);
        $this->ratingDelta = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 place = 6;</code>
     * @return int
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Generated from protobuf field <code>int32 place = 6;</code>
     * @param int $var
     * @return $this
     */
    public function setPlace($var)
    {
        GPBUtil::checkInt32($var);
        $this->place = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string title = 7;</code>
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Generated from protobuf field <code>string title = 7;</code>
     * @param string $var
     * @return $this
     */
    public function setTitle($var)
    {
        GPBUtil::checkString($var, True);
        $this->title = $var;

        return $this;
    }

}


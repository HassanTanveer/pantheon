<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/atoms.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>common.FinalResultOfSession</code>
 */
class FinalResultOfSession extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 player_id = 1;</code>
     */
    protected $player_id = 0;
    /**
     * Generated from protobuf field <code>int32 score = 2;</code>
     */
    protected $score = 0;
    /**
     * Generated from protobuf field <code>float rating_delta = 3;</code>
     */
    protected $rating_delta = 0.0;
    /**
     * Generated from protobuf field <code>int32 place = 4;</code>
     */
    protected $place = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $player_id
     *     @type int $score
     *     @type float $rating_delta
     *     @type int $place
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Proto\Atoms::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>int32 player_id = 1;</code>
     * @return int
     */
    public function getPlayerId()
    {
        return $this->player_id;
    }

    /**
     * Generated from protobuf field <code>int32 player_id = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setPlayerId($var)
    {
        GPBUtil::checkInt32($var);
        $this->player_id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 score = 2;</code>
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Generated from protobuf field <code>int32 score = 2;</code>
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
     * Generated from protobuf field <code>float rating_delta = 3;</code>
     * @return float
     */
    public function getRatingDelta()
    {
        return $this->rating_delta;
    }

    /**
     * Generated from protobuf field <code>float rating_delta = 3;</code>
     * @param float $var
     * @return $this
     */
    public function setRatingDelta($var)
    {
        GPBUtil::checkFloat($var);
        $this->rating_delta = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 place = 4;</code>
     * @return int
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Generated from protobuf field <code>int32 place = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setPlace($var)
    {
        GPBUtil::checkInt32($var);
        $this->place = $var;

        return $this;
    }

}


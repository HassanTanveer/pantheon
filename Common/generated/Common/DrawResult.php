<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/atoms.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.DrawResult</code>
 */
class DrawResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 roundIndex = 1;</code>
     */
    protected $roundIndex = 0;
    /**
     * Generated from protobuf field <code>int32 honba = 2;</code>
     */
    protected $honba = 0;
    /**
     * player ids
     *
     * Generated from protobuf field <code>repeated int32 riichiBets = 3;</code>
     */
    private $riichiBets;
    /**
     * player ids
     *
     * Generated from protobuf field <code>repeated int32 tempai = 4;</code>
     */
    private $tempai;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $roundIndex
     *     @type int $honba
     *     @type array<int>|\Google\Protobuf\Internal\RepeatedField $riichiBets
     *           player ids
     *     @type array<int>|\Google\Protobuf\Internal\RepeatedField $tempai
     *           player ids
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Proto\Atoms::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>int32 roundIndex = 1;</code>
     * @return int
     */
    public function getRoundIndex()
    {
        return $this->roundIndex;
    }

    /**
     * Generated from protobuf field <code>int32 roundIndex = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setRoundIndex($var)
    {
        GPBUtil::checkInt32($var);
        $this->roundIndex = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 honba = 2;</code>
     * @return int
     */
    public function getHonba()
    {
        return $this->honba;
    }

    /**
     * Generated from protobuf field <code>int32 honba = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setHonba($var)
    {
        GPBUtil::checkInt32($var);
        $this->honba = $var;

        return $this;
    }

    /**
     * player ids
     *
     * Generated from protobuf field <code>repeated int32 riichiBets = 3;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getRiichiBets()
    {
        return $this->riichiBets;
    }

    /**
     * player ids
     *
     * Generated from protobuf field <code>repeated int32 riichiBets = 3;</code>
     * @param array<int>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setRiichiBets($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::INT32);
        $this->riichiBets = $arr;

        return $this;
    }

    /**
     * player ids
     *
     * Generated from protobuf field <code>repeated int32 tempai = 4;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getTempai()
    {
        return $this->tempai;
    }

    /**
     * player ids
     *
     * Generated from protobuf field <code>repeated int32 tempai = 4;</code>
     * @param array<int>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setTempai($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::INT32);
        $this->tempai = $arr;

        return $this;
    }

}


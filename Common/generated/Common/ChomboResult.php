<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: atoms.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.ChomboResult</code>
 */
class ChomboResult extends \Google\Protobuf\Internal\Message
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
     * Generated from protobuf field <code>int32 loserId = 3;</code>
     */
    protected $loserId = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $roundIndex
     *     @type int $honba
     *     @type int $loserId
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Atoms::initOnce();
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
     * Generated from protobuf field <code>int32 loserId = 3;</code>
     * @return int
     */
    public function getLoserId()
    {
        return $this->loserId;
    }

    /**
     * Generated from protobuf field <code>int32 loserId = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setLoserId($var)
    {
        GPBUtil::checkInt32($var);
        $this->loserId = $var;

        return $this;
    }

}


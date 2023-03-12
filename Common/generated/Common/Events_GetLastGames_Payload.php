<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: mimir.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.Events_GetLastGames_Payload</code>
 */
class Events_GetLastGames_Payload extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated int32 eventIdList = 1;</code>
     */
    private $eventIdList;
    /**
     * Generated from protobuf field <code>int32 limit = 2;</code>
     */
    protected $limit = 0;
    /**
     * Generated from protobuf field <code>int32 offset = 3;</code>
     */
    protected $offset = 0;
    /**
     * Generated from protobuf field <code>optional string orderBy = 4;</code>
     */
    protected $orderBy = null;
    /**
     * Generated from protobuf field <code>optional string order = 5;</code>
     */
    protected $order = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type array<int>|\Google\Protobuf\Internal\RepeatedField $eventIdList
     *     @type int $limit
     *     @type int $offset
     *     @type string $orderBy
     *     @type string $order
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Mimir::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>repeated int32 eventIdList = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getEventIdList()
    {
        return $this->eventIdList;
    }

    /**
     * Generated from protobuf field <code>repeated int32 eventIdList = 1;</code>
     * @param array<int>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setEventIdList($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::INT32);
        $this->eventIdList = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 limit = 2;</code>
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * Generated from protobuf field <code>int32 limit = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setLimit($var)
    {
        GPBUtil::checkInt32($var);
        $this->limit = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 offset = 3;</code>
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * Generated from protobuf field <code>int32 offset = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setOffset($var)
    {
        GPBUtil::checkInt32($var);
        $this->offset = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>optional string orderBy = 4;</code>
     * @return string
     */
    public function getOrderBy()
    {
        return isset($this->orderBy) ? $this->orderBy : '';
    }

    public function hasOrderBy()
    {
        return isset($this->orderBy);
    }

    public function clearOrderBy()
    {
        unset($this->orderBy);
    }

    /**
     * Generated from protobuf field <code>optional string orderBy = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setOrderBy($var)
    {
        GPBUtil::checkString($var, True);
        $this->orderBy = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>optional string order = 5;</code>
     * @return string
     */
    public function getOrder()
    {
        return isset($this->order) ? $this->order : '';
    }

    public function hasOrder()
    {
        return isset($this->order);
    }

    public function clearOrder()
    {
        unset($this->order);
    }

    /**
     * Generated from protobuf field <code>optional string order = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setOrder($var)
    {
        GPBUtil::checkString($var, True);
        $this->order = $var;

        return $this;
    }

}


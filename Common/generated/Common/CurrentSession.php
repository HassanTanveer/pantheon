<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: atoms.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.CurrentSession</code>
 */
class CurrentSession extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string sessionHash = 1;</code>
     */
    protected $sessionHash = '';
    /**
     * Generated from protobuf field <code>string status = 2;</code>
     */
    protected $status = '';
    /**
     * Generated from protobuf field <code>optional int32 tableIndex = 3;</code>
     */
    protected $tableIndex = null;
    /**
     * Generated from protobuf field <code>repeated .Common.PlayerInSession players = 4;</code>
     */
    private $players;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $sessionHash
     *     @type string $status
     *     @type int $tableIndex
     *     @type array<\Common\PlayerInSession>|\Google\Protobuf\Internal\RepeatedField $players
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Atoms::initOnce();
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
     * Generated from protobuf field <code>string status = 2;</code>
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Generated from protobuf field <code>string status = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setStatus($var)
    {
        GPBUtil::checkString($var, True);
        $this->status = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>optional int32 tableIndex = 3;</code>
     * @return int
     */
    public function getTableIndex()
    {
        return isset($this->tableIndex) ? $this->tableIndex : 0;
    }

    public function hasTableIndex()
    {
        return isset($this->tableIndex);
    }

    public function clearTableIndex()
    {
        unset($this->tableIndex);
    }

    /**
     * Generated from protobuf field <code>optional int32 tableIndex = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setTableIndex($var)
    {
        GPBUtil::checkInt32($var);
        $this->tableIndex = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .Common.PlayerInSession players = 4;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Generated from protobuf field <code>repeated .Common.PlayerInSession players = 4;</code>
     * @param array<\Common\PlayerInSession>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setPlayers($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Common\PlayerInSession::class);
        $this->players = $arr;

        return $this;
    }

}


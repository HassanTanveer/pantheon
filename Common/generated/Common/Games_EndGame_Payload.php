<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/mimir.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.Games_EndGame_Payload</code>
 */
class Games_EndGame_Payload extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string sessionHash = 1;</code>
     */
    protected $sessionHash = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $sessionHash
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Proto\Mimir::initOnce();
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

}


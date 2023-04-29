<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/mimir.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.Games_DropLastRound_Payload</code>
 */
class Games_DropLastRound_Payload extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string sessionHash = 1;</code>
     */
    protected $sessionHash = '';
    /**
     * Generated from protobuf field <code>repeated .Common.IntermediateResultOfSession intermediateResults = 2;</code>
     */
    private $intermediateResults;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $sessionHash
     *     @type array<\Common\IntermediateResultOfSession>|\Google\Protobuf\Internal\RepeatedField $intermediateResults
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

    /**
     * Generated from protobuf field <code>repeated .Common.IntermediateResultOfSession intermediateResults = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getIntermediateResults()
    {
        return $this->intermediateResults;
    }

    /**
     * Generated from protobuf field <code>repeated .Common.IntermediateResultOfSession intermediateResults = 2;</code>
     * @param array<\Common\IntermediateResultOfSession>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setIntermediateResults($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Common\IntermediateResultOfSession::class);
        $this->intermediateResults = $arr;

        return $this;
    }

}


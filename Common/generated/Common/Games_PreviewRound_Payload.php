<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: mimir.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.Games_PreviewRound_Payload</code>
 */
class Games_PreviewRound_Payload extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string sessionHash = 1;</code>
     */
    protected $sessionHash = '';
    /**
     * Generated from protobuf field <code>.Common.Round roundData = 2;</code>
     */
    protected $roundData = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $sessionHash
     *     @type \Common\Round $roundData
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Mimir::initOnce();
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
     * Generated from protobuf field <code>.Common.Round roundData = 2;</code>
     * @return \Common\Round|null
     */
    public function getRoundData()
    {
        return $this->roundData;
    }

    public function hasRoundData()
    {
        return isset($this->roundData);
    }

    public function clearRoundData()
    {
        unset($this->roundData);
    }

    /**
     * Generated from protobuf field <code>.Common.Round roundData = 2;</code>
     * @param \Common\Round $var
     * @return $this
     */
    public function setRoundData($var)
    {
        GPBUtil::checkMessage($var, \Common\Round::class);
        $this->roundData = $var;

        return $this;
    }

}


<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: atoms.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.RegisteredPlayer</code>
 */
class RegisteredPlayer extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 id = 1;</code>
     */
    protected $id = 0;
    /**
     * Generated from protobuf field <code>string title = 2;</code>
     */
    protected $title = '';
    /**
     * Generated from protobuf field <code>optional int32 localId = 3;</code>
     */
    protected $localId = null;
    /**
     * Generated from protobuf field <code>optional string teamName = 4;</code>
     */
    protected $teamName = null;
    /**
     * Generated from protobuf field <code>string tenhouId = 5;</code>
     */
    protected $tenhouId = '';
    /**
     * Generated from protobuf field <code>bool ignoreSeating = 6;</code>
     */
    protected $ignoreSeating = false;
    /**
     * Generated from protobuf field <code>optional .Common.ReplacementPlayer replacedBy = 7;</code>
     */
    protected $replacedBy = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $id
     *     @type string $title
     *     @type int $localId
     *     @type string $teamName
     *     @type string $tenhouId
     *     @type bool $ignoreSeating
     *     @type \Common\ReplacementPlayer $replacedBy
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Atoms::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>int32 id = 1;</code>
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Generated from protobuf field <code>int32 id = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setId($var)
    {
        GPBUtil::checkInt32($var);
        $this->id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string title = 2;</code>
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Generated from protobuf field <code>string title = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setTitle($var)
    {
        GPBUtil::checkString($var, True);
        $this->title = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>optional int32 localId = 3;</code>
     * @return int
     */
    public function getLocalId()
    {
        return isset($this->localId) ? $this->localId : 0;
    }

    public function hasLocalId()
    {
        return isset($this->localId);
    }

    public function clearLocalId()
    {
        unset($this->localId);
    }

    /**
     * Generated from protobuf field <code>optional int32 localId = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setLocalId($var)
    {
        GPBUtil::checkInt32($var);
        $this->localId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>optional string teamName = 4;</code>
     * @return string
     */
    public function getTeamName()
    {
        return isset($this->teamName) ? $this->teamName : '';
    }

    public function hasTeamName()
    {
        return isset($this->teamName);
    }

    public function clearTeamName()
    {
        unset($this->teamName);
    }

    /**
     * Generated from protobuf field <code>optional string teamName = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setTeamName($var)
    {
        GPBUtil::checkString($var, True);
        $this->teamName = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string tenhouId = 5;</code>
     * @return string
     */
    public function getTenhouId()
    {
        return $this->tenhouId;
    }

    /**
     * Generated from protobuf field <code>string tenhouId = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setTenhouId($var)
    {
        GPBUtil::checkString($var, True);
        $this->tenhouId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool ignoreSeating = 6;</code>
     * @return bool
     */
    public function getIgnoreSeating()
    {
        return $this->ignoreSeating;
    }

    /**
     * Generated from protobuf field <code>bool ignoreSeating = 6;</code>
     * @param bool $var
     * @return $this
     */
    public function setIgnoreSeating($var)
    {
        GPBUtil::checkBool($var);
        $this->ignoreSeating = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>optional .Common.ReplacementPlayer replacedBy = 7;</code>
     * @return \Common\ReplacementPlayer|null
     */
    public function getReplacedBy()
    {
        return $this->replacedBy;
    }

    public function hasReplacedBy()
    {
        return isset($this->replacedBy);
    }

    public function clearReplacedBy()
    {
        unset($this->replacedBy);
    }

    /**
     * Generated from protobuf field <code>optional .Common.ReplacementPlayer replacedBy = 7;</code>
     * @param \Common\ReplacementPlayer $var
     * @return $this
     */
    public function setReplacedBy($var)
    {
        GPBUtil::checkMessage($var, \Common\ReplacementPlayer::class);
        $this->replacedBy = $var;

        return $this;
    }

}


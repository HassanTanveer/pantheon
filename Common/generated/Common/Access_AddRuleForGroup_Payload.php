<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/frey.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.Access_AddRuleForGroup_Payload</code>
 */
class Access_AddRuleForGroup_Payload extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string ruleName = 1;</code>
     */
    protected $ruleName = '';
    /**
     * Generated from protobuf field <code>.Common.RuleValue ruleValue = 2;</code>
     */
    protected $ruleValue = null;
    /**
     * Generated from protobuf field <code>string ruleType = 3;</code>
     */
    protected $ruleType = '';
    /**
     * Generated from protobuf field <code>int32 groupId = 4;</code>
     */
    protected $groupId = 0;
    /**
     * Generated from protobuf field <code>int32 eventId = 5;</code>
     */
    protected $eventId = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $ruleName
     *     @type \Common\RuleValue $ruleValue
     *     @type string $ruleType
     *     @type int $groupId
     *     @type int $eventId
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Proto\Frey::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string ruleName = 1;</code>
     * @return string
     */
    public function getRuleName()
    {
        return $this->ruleName;
    }

    /**
     * Generated from protobuf field <code>string ruleName = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setRuleName($var)
    {
        GPBUtil::checkString($var, True);
        $this->ruleName = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.Common.RuleValue ruleValue = 2;</code>
     * @return \Common\RuleValue|null
     */
    public function getRuleValue()
    {
        return $this->ruleValue;
    }

    public function hasRuleValue()
    {
        return isset($this->ruleValue);
    }

    public function clearRuleValue()
    {
        unset($this->ruleValue);
    }

    /**
     * Generated from protobuf field <code>.Common.RuleValue ruleValue = 2;</code>
     * @param \Common\RuleValue $var
     * @return $this
     */
    public function setRuleValue($var)
    {
        GPBUtil::checkMessage($var, \Common\RuleValue::class);
        $this->ruleValue = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string ruleType = 3;</code>
     * @return string
     */
    public function getRuleType()
    {
        return $this->ruleType;
    }

    /**
     * Generated from protobuf field <code>string ruleType = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setRuleType($var)
    {
        GPBUtil::checkString($var, True);
        $this->ruleType = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 groupId = 4;</code>
     * @return int
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * Generated from protobuf field <code>int32 groupId = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setGroupId($var)
    {
        GPBUtil::checkInt32($var);
        $this->groupId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 eventId = 5;</code>
     * @return int
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Generated from protobuf field <code>int32 eventId = 5;</code>
     * @param int $var
     * @return $this
     */
    public function setEventId($var)
    {
        GPBUtil::checkInt32($var);
        $this->eventId = $var;

        return $this;
    }

}


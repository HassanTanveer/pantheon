<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/frey.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.Access_GetAccessRules_Response</code>
 */
class Access_GetAccessRules_Response extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.Common.AccessRules rules = 1;</code>
     */
    protected $rules = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Common\AccessRules $rules
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Proto\Frey::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>.Common.AccessRules rules = 1;</code>
     * @return \Common\AccessRules|null
     */
    public function getRules()
    {
        return $this->rules;
    }

    public function hasRules()
    {
        return isset($this->rules);
    }

    public function clearRules()
    {
        unset($this->rules);
    }

    /**
     * Generated from protobuf field <code>.Common.AccessRules rules = 1;</code>
     * @param \Common\AccessRules $var
     * @return $this
     */
    public function setRules($var)
    {
        GPBUtil::checkMessage($var, \Common\AccessRules::class);
        $this->rules = $var;

        return $this;
    }

}


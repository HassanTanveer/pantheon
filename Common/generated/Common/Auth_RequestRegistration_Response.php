<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/frey.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.Auth_RequestRegistration_Response</code>
 */
class Auth_RequestRegistration_Response extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string approvalCode = 1;</code>
     */
    protected $approvalCode = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $approvalCode
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Proto\Frey::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string approvalCode = 1;</code>
     * @return string
     */
    public function getApprovalCode()
    {
        return $this->approvalCode;
    }

    /**
     * Generated from protobuf field <code>string approvalCode = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setApprovalCode($var)
    {
        GPBUtil::checkString($var, True);
        $this->approvalCode = $var;

        return $this;
    }

}


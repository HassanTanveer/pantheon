<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: frey.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.Access_GetSuperadminFlag_Payload</code>
 */
class Access_GetSuperadminFlag_Payload extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 personId = 1;</code>
     */
    protected $personId = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $personId
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Frey::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>int32 personId = 1;</code>
     * @return int
     */
    public function getPersonId()
    {
        return $this->personId;
    }

    /**
     * Generated from protobuf field <code>int32 personId = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setPersonId($var)
    {
        GPBUtil::checkInt32($var);
        $this->personId = $var;

        return $this;
    }

}


<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/frey.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.Persons_GetGroupsOfPerson_Response</code>
 */
class Persons_GetGroupsOfPerson_Response extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .Common.Group groups = 1;</code>
     */
    private $groups;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type array<\Common\Group>|\Google\Protobuf\Internal\RepeatedField $groups
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Proto\Frey::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>repeated .Common.Group groups = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Generated from protobuf field <code>repeated .Common.Group groups = 1;</code>
     * @param array<\Common\Group>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setGroups($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Common\Group::class);
        $this->groups = $arr;

        return $this;
    }

}


<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/frey.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.Persons_GetPersonsOfGroup_Response</code>
 */
class Persons_GetPersonsOfGroup_Response extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .Common.Person persons = 1;</code>
     */
    private $persons;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type array<\Common\Person>|\Google\Protobuf\Internal\RepeatedField $persons
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Proto\Frey::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>repeated .Common.Person persons = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getPersons()
    {
        return $this->persons;
    }

    /**
     * Generated from protobuf field <code>repeated .Common.Person persons = 1;</code>
     * @param array<\Common\Person>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setPersons($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Common\Person::class);
        $this->persons = $arr;

        return $this;
    }

}


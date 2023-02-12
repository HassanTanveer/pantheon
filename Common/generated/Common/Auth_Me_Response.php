<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: frey.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.Auth_Me_Response</code>
 */
class Auth_Me_Response extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 personId = 1;</code>
     */
    protected $personId = 0;
    /**
     * Generated from protobuf field <code>string country = 2;</code>
     */
    protected $country = '';
    /**
     * Generated from protobuf field <code>string city = 3;</code>
     */
    protected $city = '';
    /**
     * Generated from protobuf field <code>string email = 4;</code>
     */
    protected $email = '';
    /**
     * Generated from protobuf field <code>string phone = 5;</code>
     */
    protected $phone = '';
    /**
     * Generated from protobuf field <code>string tenhouId = 6;</code>
     */
    protected $tenhouId = '';
    /**
     * Generated from protobuf field <code>string title = 7;</code>
     */
    protected $title = '';
    /**
     * Generated from protobuf field <code>repeated int32 groups = 8;</code>
     */
    private $groups;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $personId
     *     @type string $country
     *     @type string $city
     *     @type string $email
     *     @type string $phone
     *     @type string $tenhouId
     *     @type string $title
     *     @type array<int>|\Google\Protobuf\Internal\RepeatedField $groups
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

    /**
     * Generated from protobuf field <code>string country = 2;</code>
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Generated from protobuf field <code>string country = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setCountry($var)
    {
        GPBUtil::checkString($var, True);
        $this->country = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string city = 3;</code>
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Generated from protobuf field <code>string city = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setCity($var)
    {
        GPBUtil::checkString($var, True);
        $this->city = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string email = 4;</code>
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Generated from protobuf field <code>string email = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setEmail($var)
    {
        GPBUtil::checkString($var, True);
        $this->email = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string phone = 5;</code>
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Generated from protobuf field <code>string phone = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setPhone($var)
    {
        GPBUtil::checkString($var, True);
        $this->phone = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string tenhouId = 6;</code>
     * @return string
     */
    public function getTenhouId()
    {
        return $this->tenhouId;
    }

    /**
     * Generated from protobuf field <code>string tenhouId = 6;</code>
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
     * Generated from protobuf field <code>string title = 7;</code>
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Generated from protobuf field <code>string title = 7;</code>
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
     * Generated from protobuf field <code>repeated int32 groups = 8;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Generated from protobuf field <code>repeated int32 groups = 8;</code>
     * @param array<int>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setGroups($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::INT32);
        $this->groups = $arr;

        return $this;
    }

}


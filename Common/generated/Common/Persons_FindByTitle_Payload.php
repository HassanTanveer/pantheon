<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: frey.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.Persons_FindByTitle_Payload</code>
 */
class Persons_FindByTitle_Payload extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string query = 1;</code>
     */
    protected $query = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $query
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Frey::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string query = 1;</code>
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Generated from protobuf field <code>string query = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setQuery($var)
    {
        GPBUtil::checkString($var, True);
        $this->query = $var;

        return $this;
    }

}


<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/mimir.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.Events_GetTablesState_Response</code>
 */
class Events_GetTablesState_Response extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .Common.TableState tables = 1;</code>
     */
    private $tables;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type array<\Common\TableState>|\Google\Protobuf\Internal\RepeatedField $tables
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Proto\Mimir::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>repeated .Common.TableState tables = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getTables()
    {
        return $this->tables;
    }

    /**
     * Generated from protobuf field <code>repeated .Common.TableState tables = 1;</code>
     * @param array<\Common\TableState>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setTables($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Common\TableState::class);
        $this->tables = $arr;

        return $this;
    }

}


<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: atoms.proto

namespace Common;

use UnexpectedValueException;

/**
 * Protobuf type <code>Common.SessionStatus</code>
 */
class SessionStatus
{
    /**
     * Generated from protobuf enum <code>PLANNED = 0;</code>
     */
    const PLANNED = 0;
    /**
     * Generated from protobuf enum <code>INPROGRESS = 1;</code>
     */
    const INPROGRESS = 1;
    /**
     * Generated from protobuf enum <code>PREFINISHED = 2;</code>
     */
    const PREFINISHED = 2;
    /**
     * Generated from protobuf enum <code>FINISHED = 3;</code>
     */
    const FINISHED = 3;
    /**
     * Generated from protobuf enum <code>CANCELLED = 4;</code>
     */
    const CANCELLED = 4;

    private static $valueToName = [
        self::PLANNED => 'PLANNED',
        self::INPROGRESS => 'INPROGRESS',
        self::PREFINISHED => 'PREFINISHED',
        self::FINISHED => 'FINISHED',
        self::CANCELLED => 'CANCELLED',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}


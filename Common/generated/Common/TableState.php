<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: atoms.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Common.TableState</code>
 */
class TableState extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.Common.SessionStatus status = 1;</code>
     */
    protected $status = 0;
    /**
     * Generated from protobuf field <code>bool mayDefinalize = 2;</code>
     */
    protected $mayDefinalize = false;
    /**
     * Generated from protobuf field <code>string sessionHash = 3;</code>
     */
    protected $sessionHash = '';
    /**
     * Generated from protobuf field <code>repeated .Common.Penalty penaltyLog = 4;</code>
     */
    private $penaltyLog;
    /**
     * Generated from protobuf field <code>optional int32 tableIndex = 5;</code>
     */
    protected $tableIndex = null;
    /**
     * Generated from protobuf field <code>optional .Common.Round lastRound = 6;</code>
     */
    protected $lastRound = null;
    /**
     * Generated from protobuf field <code>int32 currentRoundIndex = 7;</code>
     */
    protected $currentRoundIndex = 0;
    /**
     * Generated from protobuf field <code>repeated .Common.IntermediateResultOfSession scores = 8;</code>
     */
    private $scores;
    /**
     * Generated from protobuf field <code>repeated .Common.RegisteredPlayer players = 9;</code>
     */
    private $players;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $status
     *     @type bool $mayDefinalize
     *     @type string $sessionHash
     *     @type array<\Common\Penalty>|\Google\Protobuf\Internal\RepeatedField $penaltyLog
     *     @type int $tableIndex
     *     @type \Common\Round $lastRound
     *     @type int $currentRoundIndex
     *     @type array<\Common\IntermediateResultOfSession>|\Google\Protobuf\Internal\RepeatedField $scores
     *     @type array<\Common\RegisteredPlayer>|\Google\Protobuf\Internal\RepeatedField $players
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Atoms::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>.Common.SessionStatus status = 1;</code>
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Generated from protobuf field <code>.Common.SessionStatus status = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setStatus($var)
    {
        GPBUtil::checkEnum($var, \Common\SessionStatus::class);
        $this->status = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool mayDefinalize = 2;</code>
     * @return bool
     */
    public function getMayDefinalize()
    {
        return $this->mayDefinalize;
    }

    /**
     * Generated from protobuf field <code>bool mayDefinalize = 2;</code>
     * @param bool $var
     * @return $this
     */
    public function setMayDefinalize($var)
    {
        GPBUtil::checkBool($var);
        $this->mayDefinalize = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string sessionHash = 3;</code>
     * @return string
     */
    public function getSessionHash()
    {
        return $this->sessionHash;
    }

    /**
     * Generated from protobuf field <code>string sessionHash = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setSessionHash($var)
    {
        GPBUtil::checkString($var, True);
        $this->sessionHash = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .Common.Penalty penaltyLog = 4;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getPenaltyLog()
    {
        return $this->penaltyLog;
    }

    /**
     * Generated from protobuf field <code>repeated .Common.Penalty penaltyLog = 4;</code>
     * @param array<\Common\Penalty>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setPenaltyLog($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Common\Penalty::class);
        $this->penaltyLog = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>optional int32 tableIndex = 5;</code>
     * @return int
     */
    public function getTableIndex()
    {
        return isset($this->tableIndex) ? $this->tableIndex : 0;
    }

    public function hasTableIndex()
    {
        return isset($this->tableIndex);
    }

    public function clearTableIndex()
    {
        unset($this->tableIndex);
    }

    /**
     * Generated from protobuf field <code>optional int32 tableIndex = 5;</code>
     * @param int $var
     * @return $this
     */
    public function setTableIndex($var)
    {
        GPBUtil::checkInt32($var);
        $this->tableIndex = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>optional .Common.Round lastRound = 6;</code>
     * @return \Common\Round|null
     */
    public function getLastRound()
    {
        return $this->lastRound;
    }

    public function hasLastRound()
    {
        return isset($this->lastRound);
    }

    public function clearLastRound()
    {
        unset($this->lastRound);
    }

    /**
     * Generated from protobuf field <code>optional .Common.Round lastRound = 6;</code>
     * @param \Common\Round $var
     * @return $this
     */
    public function setLastRound($var)
    {
        GPBUtil::checkMessage($var, \Common\Round::class);
        $this->lastRound = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 currentRoundIndex = 7;</code>
     * @return int
     */
    public function getCurrentRoundIndex()
    {
        return $this->currentRoundIndex;
    }

    /**
     * Generated from protobuf field <code>int32 currentRoundIndex = 7;</code>
     * @param int $var
     * @return $this
     */
    public function setCurrentRoundIndex($var)
    {
        GPBUtil::checkInt32($var);
        $this->currentRoundIndex = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .Common.IntermediateResultOfSession scores = 8;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getScores()
    {
        return $this->scores;
    }

    /**
     * Generated from protobuf field <code>repeated .Common.IntermediateResultOfSession scores = 8;</code>
     * @param array<\Common\IntermediateResultOfSession>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setScores($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Common\IntermediateResultOfSession::class);
        $this->scores = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .Common.RegisteredPlayer players = 9;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Generated from protobuf field <code>repeated .Common.RegisteredPlayer players = 9;</code>
     * @param array<\Common\RegisteredPlayer>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setPlayers($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Common\RegisteredPlayer::class);
        $this->players = $arr;

        return $this;
    }

}


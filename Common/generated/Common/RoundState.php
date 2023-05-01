<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/atoms.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>common.RoundState</code>
 */
class RoundState extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string session_hash = 1;</code>
     */
    protected $session_hash = '';
    /**
     * player id
     *
     * Generated from protobuf field <code>int32 dealer = 2;</code>
     */
    protected $dealer = 0;
    /**
     * Generated from protobuf field <code>int32 round_index = 3;</code>
     */
    protected $round_index = 0;
    /**
     * riichis on table
     *
     * Generated from protobuf field <code>int32 riichi = 4;</code>
     */
    protected $riichi = 0;
    /**
     * honba on table
     *
     * Generated from protobuf field <code>int32 honba = 5;</code>
     */
    protected $honba = 0;
    /**
     * player ids
     *
     * Generated from protobuf field <code>repeated int32 riichi_ids = 6;</code>
     */
    private $riichi_ids;
    /**
     * scores AFTER payments
     *
     * Generated from protobuf field <code>repeated .common.IntermediateResultOfSession scores = 7;</code>
     */
    private $scores;
    /**
     * Generated from protobuf field <code>repeated .common.IntermediateResultOfSession scores_delta = 8;</code>
     */
    private $scores_delta;
    /**
     * Generated from protobuf field <code>.common.PaymentLog payments = 9;</code>
     */
    protected $payments = null;
    /**
     * Generated from protobuf field <code>.common.Round round = 10;</code>
     */
    protected $round = null;
    /**
     * Generated from protobuf field <code>.common.RoundOutcome outcome = 11;</code>
     */
    protected $outcome = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $session_hash
     *     @type int $dealer
     *           player id
     *     @type int $round_index
     *     @type int $riichi
     *           riichis on table
     *     @type int $honba
     *           honba on table
     *     @type array<int>|\Google\Protobuf\Internal\RepeatedField $riichi_ids
     *           player ids
     *     @type array<\Common\IntermediateResultOfSession>|\Google\Protobuf\Internal\RepeatedField $scores
     *           scores AFTER payments
     *     @type array<\Common\IntermediateResultOfSession>|\Google\Protobuf\Internal\RepeatedField $scores_delta
     *     @type \Common\PaymentLog $payments
     *     @type \Common\Round $round
     *     @type int $outcome
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Proto\Atoms::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string session_hash = 1;</code>
     * @return string
     */
    public function getSessionHash()
    {
        return $this->session_hash;
    }

    /**
     * Generated from protobuf field <code>string session_hash = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setSessionHash($var)
    {
        GPBUtil::checkString($var, True);
        $this->session_hash = $var;

        return $this;
    }

    /**
     * player id
     *
     * Generated from protobuf field <code>int32 dealer = 2;</code>
     * @return int
     */
    public function getDealer()
    {
        return $this->dealer;
    }

    /**
     * player id
     *
     * Generated from protobuf field <code>int32 dealer = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setDealer($var)
    {
        GPBUtil::checkInt32($var);
        $this->dealer = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 round_index = 3;</code>
     * @return int
     */
    public function getRoundIndex()
    {
        return $this->round_index;
    }

    /**
     * Generated from protobuf field <code>int32 round_index = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setRoundIndex($var)
    {
        GPBUtil::checkInt32($var);
        $this->round_index = $var;

        return $this;
    }

    /**
     * riichis on table
     *
     * Generated from protobuf field <code>int32 riichi = 4;</code>
     * @return int
     */
    public function getRiichi()
    {
        return $this->riichi;
    }

    /**
     * riichis on table
     *
     * Generated from protobuf field <code>int32 riichi = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setRiichi($var)
    {
        GPBUtil::checkInt32($var);
        $this->riichi = $var;

        return $this;
    }

    /**
     * honba on table
     *
     * Generated from protobuf field <code>int32 honba = 5;</code>
     * @return int
     */
    public function getHonba()
    {
        return $this->honba;
    }

    /**
     * honba on table
     *
     * Generated from protobuf field <code>int32 honba = 5;</code>
     * @param int $var
     * @return $this
     */
    public function setHonba($var)
    {
        GPBUtil::checkInt32($var);
        $this->honba = $var;

        return $this;
    }

    /**
     * player ids
     *
     * Generated from protobuf field <code>repeated int32 riichi_ids = 6;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getRiichiIds()
    {
        return $this->riichi_ids;
    }

    /**
     * player ids
     *
     * Generated from protobuf field <code>repeated int32 riichi_ids = 6;</code>
     * @param array<int>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setRiichiIds($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::INT32);
        $this->riichi_ids = $arr;

        return $this;
    }

    /**
     * scores AFTER payments
     *
     * Generated from protobuf field <code>repeated .common.IntermediateResultOfSession scores = 7;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getScores()
    {
        return $this->scores;
    }

    /**
     * scores AFTER payments
     *
     * Generated from protobuf field <code>repeated .common.IntermediateResultOfSession scores = 7;</code>
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
     * Generated from protobuf field <code>repeated .common.IntermediateResultOfSession scores_delta = 8;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getScoresDelta()
    {
        return $this->scores_delta;
    }

    /**
     * Generated from protobuf field <code>repeated .common.IntermediateResultOfSession scores_delta = 8;</code>
     * @param array<\Common\IntermediateResultOfSession>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setScoresDelta($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Common\IntermediateResultOfSession::class);
        $this->scores_delta = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.common.PaymentLog payments = 9;</code>
     * @return \Common\PaymentLog|null
     */
    public function getPayments()
    {
        return $this->payments;
    }

    public function hasPayments()
    {
        return isset($this->payments);
    }

    public function clearPayments()
    {
        unset($this->payments);
    }

    /**
     * Generated from protobuf field <code>.common.PaymentLog payments = 9;</code>
     * @param \Common\PaymentLog $var
     * @return $this
     */
    public function setPayments($var)
    {
        GPBUtil::checkMessage($var, \Common\PaymentLog::class);
        $this->payments = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.common.Round round = 10;</code>
     * @return \Common\Round|null
     */
    public function getRound()
    {
        return $this->round;
    }

    public function hasRound()
    {
        return isset($this->round);
    }

    public function clearRound()
    {
        unset($this->round);
    }

    /**
     * Generated from protobuf field <code>.common.Round round = 10;</code>
     * @param \Common\Round $var
     * @return $this
     */
    public function setRound($var)
    {
        GPBUtil::checkMessage($var, \Common\Round::class);
        $this->round = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.common.RoundOutcome outcome = 11;</code>
     * @return int
     */
    public function getOutcome()
    {
        return $this->outcome;
    }

    /**
     * Generated from protobuf field <code>.common.RoundOutcome outcome = 11;</code>
     * @param int $var
     * @return $this
     */
    public function setOutcome($var)
    {
        GPBUtil::checkEnum($var, \Common\RoundOutcome::class);
        $this->outcome = $var;

        return $this;
    }

}


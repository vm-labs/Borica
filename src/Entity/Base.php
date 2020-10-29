<?php

namespace Borica\Entity;

abstract class Base
{
    /**
     * @var string
     */
    private $terminal;

    /**
     * @var int
     */
    private $type;

    /**
     * @var int
     */
    private $transactionType;

    /**
     * @var string|float|integer
     */
    private $amount;

    /**
     * @var string
     */
    private $currency = 'BGN';

    /**
     * @var int
     */
    private $orderId;

    /**
     * @var /DateTime
     */
    private $timestamp;

    /**
     * @var string
     */
    private $nonce;

    /**
     * @var string
     */
    private $sign;

    public function setType(int $type)
    {
        $this->type = $type;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setTransactionType(?int $transactionType)
    {
        $this->transactionType = $transactionType;
    }

    public function getTransactionType(): ?int
    {
        return $this->transactionType;
    }

    public function setAmount($amount)
    {
        $this->amount = number_format($amount, 2, '.', '');
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setCurrency(?string $currency)
    {
        $this->currency = $currency;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setOrderId(int $orderId)
    {
        $this->orderId = $orderId;
    }

    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    public function setTerminal(string $terminal)
    {
        $this->terminal = $terminal;
    }

    public function getTerminal(): ?string
    {
        return $this->terminal;
    }

    public function setTimestamp(string $timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function setNonce(?string $nonce)
    {
        $this->nonce = $nonce;
    }

    public function getNonce(): ?string
    {
        return $this->nonce;
    }

    public function setSign(string $sign)
    {
        $this->sign = $sign;
    }

    public function getSign(): ?string
    {
        return $this->sign;
    }
}

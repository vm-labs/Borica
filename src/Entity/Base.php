<?php

namespace Borica\Entity;

use function number_format;

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
     * @var string
     */
    private $currency = 'BGN';

    /**
     * @var string
     */
    private $orderId;

    /**
     * @var string
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

    /**
     * @var string
     */
    private $rrn;

    /**
     * @var string
     */
    private $intRef;

    /**
     * @var string
     */
    private $language = 'BG';

    public function setType(int $type): void
    {
        $this->type = $type;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setTransactionType(?int $transactionType): void
    {
        $this->transactionType = $transactionType;
    }

    public function getTransactionType(): ?int
    {
        return $this->transactionType;
    }

    public function setCurrency(?string $currency): void
    {
        $this->currency = $currency;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setOrderId(string $orderId): void
    {
        $this->orderId = $orderId;
    }

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    public function setTerminal(string $terminal): void
    {
        $this->terminal = $terminal;
    }

    public function getTerminal(): ?string
    {
        return $this->terminal;
    }

    public function setTimestamp(string $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    public function getTimestamp(): ?string
    {
        return $this->timestamp;
    }

    public function setNonce(?string $nonce): void
    {
        $this->nonce = $nonce;
    }

    public function getNonce(): ?string
    {
        return $this->nonce;
    }

    public function setSign(string $sign): void
    {
        $this->sign = $sign;
    }

    public function getSign(): ?string
    {
        return $this->sign;
    }

    public function setRrn(string $rrn): void
    {
        $this->rrn = $rrn;
    }

    public function getRrn(): ?string
    {
        return $this->rrn;
    }

    public function setIntRef(string $intRef): void
    {
        $this->intRef = $intRef;
    }

    public function getIntRef(): ?string
    {
        return $this->intRef;
    }

    public function setLanguage(?string $language): void
    {
        $this->language = $language;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }
}

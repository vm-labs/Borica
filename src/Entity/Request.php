<?php

namespace Borica\Entity;

use DateTime;

class Request extends Base
{
    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $merchant;

    /**
     * @var string
     */
    private $merchantName;

    /**
     * @var string
     */
    private $merchantUrl;

    /**
     * @var int
     */
    private $merchantGmt;

    /**
     * @var string
     */
    private $mInfo;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $country = 'BG';

    /**
     * @var string
     */
    private $language;

    /**
     * @var string
     */
    private $boricaOrderId;

    /**
     * @var string
     */
    private $addendum;

    /**
     * @var string
     */
    private $backref;

    /**
     * @var float
     */
    private $amount;

    public function __construct()
    {        
        $date = new DateTime();
        $this->setTimestamp($date->format('YmdHis'));
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setMerchant(?string $merchant): void
    {
        $this->merchant = $merchant;
    }

    public function getMerchant(): ?string
    {
        return $this->merchant;
    }

    public function setMerchantName(?string $merchantName): void
    {
        $this->merchantName = $merchantName;
    }

    public function getMerchantName(): ?string
    {
        return $this->merchantName;
    }

    public function setMerchantUrl(string $merchantUrl): void
    {
        $this->merchantUrl = $merchantUrl;
    }

    public function getMerchantUrl(): string
    {
        return $this->merchantUrl;
    }

    public function setMerchantGmt(?int $merchantGmt): void
    {
        $this->merchantGmt = $merchantGmt;
    }

    public function getMerchantGmt(): ?int
    {
        return $this->merchantGmt;
    }

    public function setMInfo(?string $info): void
    {
        $this->mInfo = $info;
    }

    public function getMInfo(): ?string
    {
        return $this->mInfo;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setLanguage(?string $language): void
    {
        $this->language = $language;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setBoricaOrderId(?string $boricaOrderId): void
    {
        $this->boricaOrderId = $boricaOrderId;
    }

    public function getBoricaOrderId(): ?string
    {
        return $this->boricaOrderId;
    }

    public function setAddendum(?string $addendum): void
    {
        $this->addendum = $addendum;
    }

    public function getAddendum(): ?string
    {
        return $this->addendum;
    }

    public function setBackref(string $backref): void
    {
        $this->backref = $backref;
    }

    public function getBackref(): string
    {
        return $this->backref;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = number_format($amount, 2, '.', '');
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }
}

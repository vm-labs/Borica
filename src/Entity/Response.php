<?php

namespace Borica\Entity;

class Response extends Base
{
    /**
     * @var int
     */
    private $action;

    /**
     * @var string
     */
    private $responseCode;

    /**
     * @var string
     */
    private $approval;

    /**
     * @var string
     */
    private $statusMsg;

    /**
     * @var string
     */
    private $card;

    /**
     * @var string
     */
    private $tranDate;

    /**
     * @var string
     */
    private $paresStatus;

    /**
     * @var int
     */
    private $eci;

    /**
     * @var string
     */
    private $amount;

    public function setAction(int $action): void
    {
        $this->action = $action;
    }

    public function getAction(): ?int
    {
        return $this->action;
    }

    public function setResponseCode(string $responseCode): void
    {
        $this->responseCode = $responseCode;
    }

    public function getresponseCode(): ?string
    {
        return $this->responseCode;
    }

    public function setApproval(?string $approval): void
    {
        $this->approval = $approval;
    }

    public function getApproval(): ?string
    {
        return $this->approval;
    }

    public function setStatusMsg(?string $statusMsg): void
    {
        $this->statusMsg = $statusMsg;
    }

    public function getStatusMsg(): ?string
    {
        return $this->statusMsg;
    }

    public function setCard(?string $card): void
    {
        $this->card = $card;
    }

    public function getCard(): ?string
    {
        return $this->card;
    }

    public function setTranDate(?string $date)
    {
        $this->tranDate = $date;
    }

    public function getTranDate(): ?string
    {
        return $this->tranDate;
    }

    public function setParesStatus(?string $status): void
    {
        $this->paresStatus = $status;
    }

    public function getParesStatus(): ?string
    {
        return $this->paresStatus;
    }

    public function setEci(int $eci): void
    {
        $this->eci = $eci;
    }

    public function getEci(): ?int
    {
        return $this->eci;
    }

    public function setAmount(string $amount): void
    {
        $this->amount = $amount;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }
}

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
    private $rc;

    /**
     * @var string
     */
    private $approval;

    /**
     * @var int
     */
    private $rrn;

    /**
     * @var string
     */
    private $intRef;

    /**
     * @var string
     */
    private $statusMsg;

    /**
     * @var string
     */
    private $card;

    /**
     * @var \DateTime
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

    public function setAction(int $action)
    {
        $this->action = $action;
    }

    public function getAction(): ?int
    {
        return $this->action;
    }

    public function setRc(string $rc)
    {
        $this->rc = $rc;
    }

    public function getRc(): ?string
    {
        return $this->rc;
    }

    public function setApproval(?string $approval)
    {
        $this->approval = $approval;
    }

    public function getApproval(): ?string
    {
        return $this->approval;
    }

    public function setRrn(int $rrn)
    {
        $this->rrn = $rrn;
    }

    public function getRrn(): ?int
    {
        return $this->rrn;
    }

    public function setIntRef(string $intRef)
    {
        $this->intRef = $intRef;
    }

    public function getIntRef(): ?string
    {
        return $this->intRef;
    }

    public function setStatusMsg(?string $statusMsg)
    {
        $this->statusMsg = $statusMsg;
    }

    public function getStatusMsg(): ?string
    {
        return $this->statusMsg;
    }

    public function setCard(?string $card)
    {
        $this->card = $card;
    }

    public function getCard(): ?string
    {
        return $this->card;
    }

    public function setTranDate($date)
    {
        $this->tranDate = $date;
    }

    public function getTranDate()
    {
        return $this->tranDate;
    }

    public function setParesStatus(?string $status)
    {
        $this->paresStatus = $status;
    }

    public function getParesStatus(): ?string
    {
        return $this->paresStatus;
    }

    public function setEci($eci)
    {
        $this->eci = $eci;
    }

    public function getEci()
    {
        return $this->eci;
    }

    public function isSuccess()
    {
        return $this->rc === '00';
    }
}

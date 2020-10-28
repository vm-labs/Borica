<?php

namespace Borica\Request;

use Borica\Entity\Request;
use Borica\Form\Type\PaymentFormType;
use Borica\Types;

class PaymentRequest extends BaseRequest
{
    public function init()
    {
        $this->request->setType(Types::PAYMENT);

        $this->setDefaultData();
        $this->signMessage();
    }

    public function getFormType(): string
    {
        return PaymentFormType::class;
    }
}

<?php

namespace Borica\Request;

use Borica\Entity\Request;
use Borica\Form\Type\PaymentFormType;
use Borica\Types;

class PaymentRequest extends BaseRequest
{
    protected function init(): void
    {
        $this->request->setType(Types::PAYMENT);

        $this->setDefaultData();
        $this->signMessage();
    }

    protected function getFormType(): string
    {
        return PaymentFormType::class;
    }

    protected function getValidationGroup(): string
    {
        return 'payment';
    }
}

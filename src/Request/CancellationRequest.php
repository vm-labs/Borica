<?php

namespace Borica\Request;

use Borica\Form\Type\CancellationFormType;
use Borica\Types;

class CancellationRequest extends BaseRequest
{
    protected function init(): void
    {
        $this->request->setType(Types::PAYMENT_CANCELLATION);

        $this->setDefaultData();
        $this->signMessage();
    }

    protected function getFormType(): string
    {
        return CancellationFormType::class;
    }

    protected function getValidationGroup(): string
    {
        return 'cancellation';
    }
}

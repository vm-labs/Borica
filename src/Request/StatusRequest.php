<?php

namespace Borica\Request;

use Borica\Form\Type\StatusRequestFormType;
use Borica\Form\Type\StatusResponseFormType;
use Borica\Types;
use Symfony\Component\HttpClient\HttpClient;

class StatusRequest extends BaseRequest
{
    public function request(string $url)
    {
        $client = HttpClient::create();
        $response = $client->request('GET', $url, [
            'query' => [
                'TERMINAL' => $this->request->getTerminal(),
                'TRTYPE' => $this->request->getType(),
                'ORDER' => $this->request->getOrder(),
                'NONCE' => $this->request->getNonce(),
                'TRAN_TRTYPE' => $this->request->getTransactionType(),
                'P_SIGN' => $this->request->getSign(),
            ],
        ]);

        $form = $this->formFactory->createBuilder(StatusResponseFormType::class, new Response())->getForm();
        $form->submit(json_decode($response->getContent(), true));

        return $form->getData();
    }

    protected function init()
    {
        $this->request->setType(Types::STATUS_TRANSACTION);
        $this->request->setTransactionType(Types::PAYMENT);

        $this->setDefaultData();
        $this->signMessage();
    }

    protected function getFormType(): string
    {
        return StatusRequestFormType::class;
    }

    protected function getValidationGroup(): string
    {
        return 'status';
    }
}

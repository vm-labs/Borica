<?php

namespace Borica\Factory;

use Borica\Entity\Response;
use Borica\Types;

trait ResponseFactory
{
    public function getResponseMessage(Response $response, bool $extendedMac = true)
    {
        $fields = $extendedMac ? $this->getResponseExtendedFields($response) : $this->getResponseCommonFields($response);

        $message = '';
        foreach ($fields as $field) {
            $message .= sprintf('%s%s', mb_strlen($field), $field);
        }

        return $message;
    }

    private function getResponseExtendedFields(Response $response)
    {
        return [
            $response->getAction(),
            $response->getResponseCode(),
            $response->getApproval(),
            $response->getTerminal(),
            $response->getType(),
            $response->getAmount(),
            $response->getCurrency(),
            $response->getOrderId(),
            $response->getRrn(),
            $response->getIntRef(),
            $response->getParesStatus(),
            $response->getEci(),
            $response->getTimestamp(),
            $response->getNonce(),
        ];
    }

    private function getResponseCommonFields(Response $response)
    {
        if (in_array($response->getType(), [Types::PAYMENT, Types::STATUS_TRANSACTION])) {
            return [
                $response->getTerminal(),
                $response->getType(),
                $response->getAmount(),
                $response->getTimestamp(),
            ];
        }

        return [
            $response->getTerminal(),
            $response->getType(),
            $response->getAmount(),
            $response->getOrderId(),
            $response->getTimestamp(),
        ];
    }
}

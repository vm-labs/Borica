<?php

namespace Borica\Factory;

use Borica\Entity\Response;
use Borica\Types;
use function in_array;
use function mb_strlen;
use function sprintf;

trait ResponseFactory
{
    public function getResponseMessage(Response $response, bool $extendedMac = true): string
    {
        $fields = $extendedMac ? $this->getResponseExtendedFields($response) : $this->getResponseCommonFields($response);

        $message = '';
        foreach ($fields as $field) {
            $message .= is_null($field) ? '1-' : sprintf('%s%s', mb_strlen($field), $field);
        }

        return $message;
    }

    private function getResponseExtendedFields(Response $response): array
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

    private function getResponseCommonFields(Response $response): array
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

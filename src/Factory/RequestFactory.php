<?php

namespace Borica\Factory;

use Borica\Entity\Request;
use Borica\Types;
use function mb_strlen;
use function sprintf;

trait RequestFactory
{
    public function getRequestMessage(Request $request, bool $extendedMac = true): string
    {
        $fields = $extendedMac ? $this->getRequestExtendedFields($request) : $this->getRequestCommonFields($request);

        $message = '';
        foreach ($fields as $field) {
            $message .= sprintf('%s%s', mb_strlen($field), $field);
        }

        return $message;
    }

    private function getRequestExtendedFields(Request $request): array
    {
        if (Types::STATUS_TRANSACTION === $request->getType()) {
            return [
                $request->getTerminal(),
                $request->getType(),
                $request->getOrderId(),
                $request->getNonce(),
            ];
        }

        return [
            $request->getTerminal(),
            $request->getType(),
            $request->getAmount(),
            $request->getCurrency(),
            $request->getOrderId(),
            $request->getMerchant(),
            $request->getTimestamp(),
            $request->getNonce(),
        ];
    }

    private function getRequestCommonFields(Request $request): array
    {
        if (Types::PAYMENT === $request->getType()) {
            return [
                $request->getTerminal(),
                $request->getType(),
                $request->getAmount(),
                $request->getCurrency(),
                $request->getTimestamp(),
            ];
        }

        if (Types::STATUS_TRANSACTION === $request->getType()) {
            return [
                $request->getTerminal(),
                $request->getType(),
                $request->getOrderId(),
            ];
        }

        return [
            $request->getTerminal(),
            $request->getType(),
            $request->getAmount(),
            $request->getTimestamp(),
            $request->getDescription(),
        ];
    }
}

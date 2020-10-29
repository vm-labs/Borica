<?php

namespace Borica\Response;

use Borica\Entity\Response;
use Borica\Factory\ResponseFactory;
use Borica\Manager\CertificateManager;

class BoricaResponse
{
    use CertificateManager;
    use ResponseFactory;

    /**
     * @var Response
     */
    private $response;

    /**
     * @var array
     */
    private $config;

    /**
     * @var bool
     */
    private $validData;

    public function __construct(Response $response, array $config)
    {
        $this->response = $response;
        $this->config = $config;

        $this->validData = $this->verifySignature();
    }

    public function isValidData(): bool
    {
        return $this->validData;
    }

    public function isSuccessful(): bool
    {
        return $this->response->getresponseCode() === '00';
    }

    public function getResponseCode()
    {
        return $this->response->getresponseCode();
    }

    public function getData(): Response
    {
        return $this->response;
    }

    private function verifySignature(): bool
    {
        $message = $this->getResponseMessage($this->response, $this->config['extended_mac']);

        return $this->isValidSignature($message, $this->response->getSign(), $this->config);
    }
}

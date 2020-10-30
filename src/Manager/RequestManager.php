<?php

namespace Borica\Manager;

use Borica\Entity\Request;
use Borica\Request\PaymentRequest;
use Borica\Request\StatusRequest;
use Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use function array_key_exists;
use function array_shift;
use function count;

class RequestManager
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var string
     */
    private $url;

    /**
     * @var array
     */
    private $configs;

    public function __construct(
        ValidatorInterface $validator,
        FormFactoryInterface $formFactory,
        string $url,
        array $configs
    ) {

        $this->validator = $validator;
        $this->formFactory = $formFactory;
        $this->url = $url;
        $this->configs = $configs;
    }

    public function payment(Request $request, string $configName = '')
    {
        return new PaymentRequest(
            $this->validator,
            $this->formFactory,
            $request,
            $this->url,
            $this->getConfig($configName)
        );
    }

    public function status(Request $request, string $configName = '')
    {
        return new StatusRequest(
            $this->validator,
            $this->formFactory,
            $request,
            $this->url,
            $this->getConfig($configName)
        );
    }

    public function cancellation(Request $request, string $configName = '')
    {
        return new CancellationRequest(
            $this->validator,
            $this->formFactory,
            $request,
            $this->url,
            $this->getConfig($configName)
        );
    }

    private function getConfig(?string $configName): array
    {
        if (count($this->configs) === 1 && !$configName) {
            return array_shift($this->configs);
        }

        if (!array_key_exists($configName, $this->configs)) {
            throw new ParameterNotFoundException($configName, RequestManager::class);
        }

        return $this->configs[$configName];
    }
}

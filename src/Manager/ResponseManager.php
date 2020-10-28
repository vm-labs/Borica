<?php

namespace Borica\Manager;

use Borica\Entity\Response;
use Borica\Form\Type\ResponseFormType;
use Borica\Response\BoricaResponse;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class ResponseManager
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var array
     */
    private $configs;

    public function __construct(RequestStack $requestStack, FormFactoryInterface $formFactory, array $configs)
    {
        $this->requestStack = $requestStack;
        $this->formFactory = $formFactory;
        $this->configs = $configs;
    }

    public function useResponse(string $configName = ''): BoricaResponse
    {
        $request = $this->requestStack->getCurrentRequest();

        if (!$request->isMethod('POST')) {
            throw new Exception("Error Processing Request", 1);
        }

        $response = new Response();
        $form = $this->formFactory->createBuilder(ResponseFormType::class, $response)->getForm();
        $form->submit($request->request->all());

        return new BoricaResponse($response, $this->getConfig($configName));
    }

    public function setResponse(Response $response, string $configName = ''): BoricaResponse
    {
        return new BoricaResponse($response, $this->getConfig($configName));
    }

    private function getConfig(?string $configName): array
    {
        if (count($this->configs) === 1 && !$configName) {
            return array_shift($this->configs);
        }

        if (!array_key_exists($configName, $this->configs)) {
            throw new ParameterNotFoundException($configName, ResponseManager::class);
        }

        return $this->configs[$configName];
    }
}

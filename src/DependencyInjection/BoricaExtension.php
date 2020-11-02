<?php

namespace Borica\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class BoricaExtension extends Extension
{
    public function getAlias()
    {
        return 'borica_api';
    }

    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $this->setRequestManagerDefinitions($container, $config);
        $this->setResponseManagerDefinitions($container, $config);
    }

    private function setRequestManagerDefinitions(ContainerBuilder $container, array $config)
    {
        $env = $container->getParameter('kernel.environment');
        $definition = $container->getDefinition('borica.request_manager');
        $definition->setArgument(2, $env === 'dev' ? $config['test_url'] : $config['prod_url']);
        $definition->setArgument(3, $config['profiles']);
    }

    private function setResponseManagerDefinitions(ContainerBuilder $container, array $config)
    {
        $definition = $container->getDefinition('borica.response_manager');
        $definition->setArgument(2, $config['profiles']);
    }
}

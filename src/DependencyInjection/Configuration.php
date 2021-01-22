<?php

namespace Borica\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('borica_api');

        $rootNode
            ->children()
                ->scalarNode('test_url')
                    ->defaultValue('https://3dsgate-dev.borica.bg/cgi-bin/cgi_link')
                ->end()
                ->scalarNode('prod_url')
                    ->defaultValue('https://3dsgate.borica.bg/cgi-bin/cgi_link')
                ->end()

                ->arrayNode('profiles')
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('merchant')->end()
                            ->scalarNode('merchant_name')->end()
                            ->scalarNode('merchant_url')->end()
                            ->scalarNode('terminal_id')
                                ->isRequired()
                                ->cannotBeEmpty()
                            ->end()
                            ->scalarNode('private_key')
                                ->isRequired()
                                ->cannotBeEmpty()
                            ->end()
                            ->scalarNode('private_key_password')
                                ->isRequired()
                                ->cannotBeEmpty()
                            ->end()
                            ->scalarNode('public_key')
                                ->isRequired()
                                ->cannotBeEmpty()
                            ->end()
                            ->booleanNode('extended_mac')
                                ->defaultTrue()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}

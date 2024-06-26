<?php

namespace EikonaMedia\Contao\ActiveFilesUsageBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('ActiveFilesUsage');

        $treeBuilder->getRootNode()
            ->children()
            ->arrayNode('table_names')
            ->scalarPrototype()->end()
            ->end()
            ->end();

        return $treeBuilder;
    }

}
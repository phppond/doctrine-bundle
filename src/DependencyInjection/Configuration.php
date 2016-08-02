<?php

namespace PhpPondBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder,
    Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @package PhpPondBundle\DependencyInjection
 * @author nick
 */
class Configuration implements ConfigurationInterface
{

    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $builder = $treeBuilder->root('phppond')->children();
        $builder->end();

        return $treeBuilder;
    }
}

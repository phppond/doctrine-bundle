<?php

namespace PhpPondBundle\DependencyInjection;


use Symfony\Component\HttpKernel\DependencyInjection\Extension,
    Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Loader\YamlFileLoader,
    Symfony\Component\Config\FileLocator;

/**
 * Class PhpPondExtension
 *
 * @package PhpPondBundle\DependencyInjection
 * @author nick
 */
class PhpPondExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('config.yml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $config);
        foreach ($config as $key => $value) {
            $this->setParameter($container, 'phppond.' . $key, $value);
        }
    }

    /**
     * @param ContainerBuilder $container
     * @param string           $name
     * @param mixed            $values
     */
    private function setParameter(ContainerBuilder $container, $name, $values)
    {
        switch (true) {
            case is_scalar($values):
                $container->setParameter($name, $values);
                break;

            case is_array($values):
            case $values instanceof \Traversable:
                foreach ($values as $key => $value) {
                    $this->setParameter($container, $name . '.' . $key, $value);
                }
                break;

            default:
                throw new \InvalidArgumentException('Invalid parameter type');
        }
    }

}

<?php

namespace LlewellynThomas\Bundle\CoinCalculatorBundle\DependencyInjection;

use LlewellynThomas\Coins\Currency\MetricCurrency;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class CoinCalculatorExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('coin_calculator.currencies', $config['currencies']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $this->buildCurrencies($config['currencies'], $container);

    }

    private function buildCurrencies($currencies, ContainerBuilder $container)
    {
        $counter = $container->getDefinition('coin.coin_counter');

        foreach ($currencies as $key => $coins) {
            $defintion = new Definition(MetricCurrency::class, [$key, $coins['coins']]);
            $counter->addMethodCall('addCurrency', [$defintion]);
        }
    }
}
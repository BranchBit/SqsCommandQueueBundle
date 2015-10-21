<?php

namespace BBIT\SqsCommandQueueBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class BBITSqsCommandQueueExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('bbit_sqs_command_queue.aws_sqs_key', $config['aws_sqs_key']);
        $container->setParameter('bbit_sqs_command_queue.aws_sqs_secret', $config['aws_sqs_secret']);
        $container->setParameter('bbit_sqs_command_queue.aws_sqs_region', $config['aws_sqs_region']);
        $container->setParameter('bbit_sqs_command_queue.aws_sqs_queue', $config['aws_sqs_queue']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}

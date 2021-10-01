<?php

declare(strict_types=1);

namespace Thn\BackendTest\Infrastructure\Delivery\Symfony;;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    private const CONFIG_EXTS = '.{php,xml,yaml,yml}';

    protected function configureContainer(ContainerConfigurator $container, LoaderInterface $loader): void
    {
        $rootPath = realpath(__DIR__.'/../../../../');
        $container->import($rootPath.'/config/{packages}/*.yaml');
        $container->import($rootPath.'/config/{packages}/'.$this->environment.'/*.yaml');
        $container->import($rootPath.'/config/services.yaml');
        $confDir = $this->getProjectDir().'/config';
        $loader->load($confDir.'/{packages}/'.$this->environment.'/*'.self::CONFIG_EXTS, 'glob');
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $rootPath = realpath(__DIR__.'/../../../../');
        $routes->import($rootPath.'/config/{routes}/'.$this->environment.'/*.yaml');
        $routes->import($rootPath.'/config/routes.yaml');
    }
}

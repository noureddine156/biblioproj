<?php

namespace ContainerWTOeiHU;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/*
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getBookControllershowService extends App_KernelProdContainer
{
    /*
     * Gets the private '.service_locator.b3R8WOF.App\Controller\BookController::show()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.b3R8WOF.App\\Controller\\BookController::show()'] = (new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'book' => ['privates', '.errored..service_locator.b3R8WOF.App\\Entity\\Book', NULL, 'Cannot autowire service ".service_locator.b3R8WOF": it needs an instance of "App\\Entity\\Book" but this type has been excluded in "config/services.yaml".'],
        ], [
            'book' => 'App\\Entity\\Book',
        ]))->withContext('App\\Controller\\BookController::show()', $container);
    }
}

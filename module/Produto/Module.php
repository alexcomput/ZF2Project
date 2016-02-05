<?php

namespace Produto;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ControllerPluginProviderInterface;
use Zend\ModuleManager\Feature\FormElementProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\EventManager\EventInterface;

class Module implements
ConfigProviderInterface, AutoloaderProviderInterface, ControllerProviderInterface, BootstrapListenerInterface, ControllerPluginProviderInterface, FormElementProviderInterface, ServiceProviderInterface, ViewHelperProviderInterface
{
    /*
     *  necessário em 1 dos modulos não precisa terem todos os modulos 
     * o metodo onBootstrap
     */

    public function onBootstrap(EventInterface $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    /*
     *  Carrega o restante da configuração
     * extensão dessa classe.
     */

    public function getConfig()
    {
        return array_merge(
                include __DIR__ . '/config/module.config.php', include __DIR__ . '/config/router.config.php'
        );
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getControllerPluginConfig()
    {
        return include __DIR__ . '/config/controller-plugin.config.php';
    }

    public function getFormElementConfig()
    {
        return include __DIR__ . '/config/form-element.config.php';
    }

    public function getServiceConfig()
    {
//        return array_merge_recursive(
//            include __DIR__ . '/config/service.config.php',
//            include __DIR__ . '/config/entity.config.php'
//        );
        return array(
            'Produto\Service\Produto' => function ($sm) {
                return new Service\Produto($sm->get('Doctrine\ORM\EntityManager'), $sm->get('View'));
            }
        );
    }

    public function getViewHelperConfig()
    {
        return include __DIR__ . '/config/view-helper.config.php';
    }

    public function getControllerConfig()
    {
        return include __DIR__ . '/config/controller.config.php';
    }

}

<?php
namespace DataFixtures;

class Module
{
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

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'DataFixtures\Model\DataFixtures' => function ($sm) {
                    $service = new \DataFixture\Model\DataFixture();
                    $service->setEntityManager($sm->get('doctrine.entitymanager.orm_default'));
                    return $service;
                },
            )
        );
    }
}

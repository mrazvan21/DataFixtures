<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'DataFixtures\Controller\DataFixtures' => 'DataFixtures\Controller\DataFixturesController',
        ),
    ),
    'router' => array(
        'routes' => array(

        ),
    ),

    'console' => array(
        'router' => array(
            'routes' => array(
                'datafixture' => array(
                    'options' => array(
                        'route'    => 'run datafixture',
                        'defaults' => array(
                            'controller' => 'DataFixtures\Controller\DataFixtures',
                            'action'     => 'run',
                            'moduleName' => 'datafixtures',
                        )
                    )
                )
            )
        )
    )
);

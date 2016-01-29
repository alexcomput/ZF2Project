<?php

namespace Produto;

return [
    'router' => [
        'routes' => [
            'home-produto' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/produto',
                    'defaults' => [ 
                        //'__NAMESPACE__' => 'Produto\Controller',
                        'controller' => 'produto',
                        'action' => 'index',
                    ],
                ],
            ],
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
//            'application' => [
//                'type' => 'Literal',
//                'options' => [
//                    'route' => '/application',
//                    'defaults' => [
//                        '__NAMESPACE__' => 'Application\Controller',
//                        'controller' => 'Index',
//                        'action' => 'index',
//                    ],
//                ],
//                'may_terminate' => true,
//                'child_routes' => [
//                    'default' => [
//                        'type' => 'Segment',
//                        'options' => [
//                            'route' => '/[:controller[/:action]]',
//                            'constraints' => [
//                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                            ],
//                            'defaults' => [
//                            ],
//                        ],
//                    ],
//                ],
//            ],
        ],
    ],
];

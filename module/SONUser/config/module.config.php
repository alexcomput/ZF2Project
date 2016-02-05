<?php

namespace SONUser;

return [
    'router' => [
        'routes' => [
            #nome da rota
            'sonuser-register' => [
                # [ Literal ] 
                # Rota mais simples. 
                # Pega na url, exatamente o que é escrito.
                # Não aceita parâmetros
                'type' => 'Literal',
                'options' => [
                    'route' => '/register',
                    'defaults' => [
                        '__NAMESPACE__' => 'SONUser\Controller',
                        'controller' => 'Index',
                        'action' => 'register',
                    ]
                ]
            ],
            'sonuser-activate' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/register/activate[/:key]',
                    'defaults' => [
                        'controller' => 'SONUser\Controller\Index',
                        'action' => 'activate',
                    ]
                ]
            ],
            'sonuser-listar' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/listar',
                    'defaults' => [
                        '__NAMESPACE__' => 'SONUser\Controller',
                        'controller' => 'Index',
                        'action' => 'listar',
                    ]
                ]
            ]
        ]
    ],
    'controllers' => [
        'invokables' => [
            'SONUser\Controller\Index' => 'SONUser\Controller\IndexController',
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'no t_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ],
            ],
        ],
        'data-fixture' => [
            __NAMESPACE__ . '_fixture' => __DIR__ . '/../src/' . __NAMESPACE__ . '/Fixture',
        ],
    ]
];

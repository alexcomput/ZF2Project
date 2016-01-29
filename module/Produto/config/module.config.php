<?php

namespace Produto;

return [
    'doctrine' => [
        'fixture' => [
            __NAMESPACE__ . '_fixture' => __DIR__ . '/../src/' . __NAMESPACE__ . '/Fixture',
        ],
        'driver' => [
            'application_entities' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => 'application_entities'
                ],
            ],
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
           __NAMESPACE__ =>__DIR__ . '/../view',
        ],
    ],    
];

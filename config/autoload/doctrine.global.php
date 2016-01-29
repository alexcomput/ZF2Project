<?php

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [
                    'port' => '3306',
                    'dbname' => 'zf_doctrine'
                ]
            ]
        ]
    ]
];

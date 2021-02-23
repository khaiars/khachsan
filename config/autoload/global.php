<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

use Laminas\Session\Storage\SessionArrayStorage;
use Laminas\Session\Validator\HttpUserAgent;
use Laminas\Session\Validator\RemoteAddr;


return [
    'doctrine' => [
        'connection' => [
            // default connection name
            'orm_default' => [
                'driverClass' => \Doctrine\DBAL\Driver\PDOMySql\Driver::class,
                'params' => [
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'root',
                    'password' => '',
                    'dbname'   => 'db_tttn',
                ],
            ],
        ],
    ],
    'session_config' => [
        'cookie_lifetime'=>3600,
        'gc_maxlifetime'=>2*3600,	
    ],
    'session_manager'=>[
        'validator'=>[
            RemoteAddr::class,
            HttpUserAgent::class,

        ]
    ],
    'session_storage'=>[
        'type' => SessionArrayStorage::class

    ]


];

<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Dkdps;

use Dkdps\Controller\DkdpController;
use Zend\ServiceManager\Factory\InvokableFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Laminas\Authentication\AuthenticationService;
use Laminas\Router\Http\Segment as HttpSegment;
use Thanhpho\Controller\ThanhphoController;
use Zend\Router\Http\Segment;


return [
    'router' => [
        'routes' => [
            'dangkydatphong' => [
                'type'    => HttpSegment::class,
                'options' => [
                    'route'    => '/dangkydatphong[/:action[/:id]]',
                    'defaults' => [
                        'controller' => Controller\DkdpController::class,
                        'action'     => 'index',
                    ],
                ],
                'constraints' => [
                    'action' => '[a-zA-Z0-9-_]*'
                ]
            ],

        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\DkdpController::class => Controller\Factory\DkdpControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view/',
        ],
    ],

    'service_manager' => [
        'factories' => [
            Service\DkdpManager::class => Service\Factory\DkdpManagerFactory::class,
        ]
    ],

    'access_filter' => [
        'controllers' =>
        [
            DkdpController::class => [
                // các action không cần yêu cầu đăng nhập
                [
                    'action' => ['datphong'],
                    'allow'  => "all"
                ],
                //các action yêu cầu đăng nhập
                [
                    'action' => ['index', 'delete','edit','add'],
                    'allow'  => "limit"
                ]
            ]
        ]
    ],

    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ]

];

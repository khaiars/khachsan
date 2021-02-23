<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Thanhpho;


use Zend\ServiceManager\Factory\InvokableFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Laminas\Authentication\AuthenticationService;
use Laminas\Router\Http\Segment as HttpSegment;
use Thanhpho\Controller\ThanhphoController;
use Zend\Router\Http\Segment;


return [
    'router' => [
        'routes' => [
            'thanhpho' => [
                'type'    => HttpSegment::class,
                'options' => [
                    'route'    => '/thanhpho[/:action[/:id]]',
                    'defaults' => [
                        'controller' => Controller\ThanhphoController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            // 'login' => [
            //     'type'    => HttpSegment::class,
            //     'options' => [
            //         'route'    => '/login',
            //         'defaults' => [
            //             'controller' => Controller\AuthController::class,
            //             'action'     => 'login',
            //         ],
            //     ],
            // ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\ThanhphoController::class => Controller\Factory\ThanhphoControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
            
           
        ],
        
        
        
    ],

    'service_manager' => [
        'factories' =>[
            Service\ThanhphoManager::class => Service\Factory\ThanhphoManagerFactory::class,
        ]
    ],

    'access_filter' => [
        'controllers' =>
        [
            ThanhphoController::class => [
                // các action không cần yêu cầu đăng nhập
                [
                    'action' => ['get'],
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

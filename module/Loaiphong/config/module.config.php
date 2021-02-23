<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Loaiphong;

use Dkdps\Controller\DkdpController;
use Zend\ServiceManager\Factory\InvokableFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Laminas\Authentication\AuthenticationService;
use Laminas\Router\Http\Segment as HttpSegment;
use Loaiphong\Controller\LoaiphongController;
use Zend\Router\Http\Segment;


return [
    'router' => [
        'routes' => [
            'lp' => [
                'type'    => HttpSegment::class,
                'options' => [
                    'route'    => '/lp[/:action[/:id]]',
                    'defaults' => [
                        'controller' => Controller\LoaiphongController::class,
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
            Controller\LoaiphongController::class => Controller\Factory\LoaiphongControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
            
           
        ],
        
        
        
    ],

    'service_manager' => [
        'factories' =>[
            Service\LoaiphongsManager::class => Service\Factory\LoaiphongManagerFactory::class,
        ]
    ],

    'access_filter' => [
        'controllers' =>
        [
            LoaiphongController::class => [
                // các action không cần yêu cầu đăng nhập
                [
                    'action' => ['getdanhsach'],
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

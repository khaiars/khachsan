<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Khachhangs;


use Zend\ServiceManager\Factory\InvokableFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Khachhangs\Controller\KhachhangController;
use Laminas\Authentication\AuthenticationService;
use Laminas\Router\Http\Segment as HttpSegment;
use Zend\Router\Http\Segment;


return [
    'router' => [
        'routes' => [
            'khachhang' => [
                'type'    => HttpSegment::class,
                'options' => [
                    'route'    => '/khachhang[/:action[/:id]]',
                    'defaults' => [
                        'controller' => Controller\KhachhangController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\KhachhangController::class => Controller\Factory\KhachhangControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
            
           
        ],
       
        
        
    ],

    'service_manager' => [
        'factories' =>[
            Service\KhachhangsManager::class => Service\Factory\KhachhangManagerFactory::class,
        ]
    ],

    'access_filter' => [
        'controllers' =>
        [
            KhachhangController::class => [
                // các action không cần yêu cầu đăng nhập
                [
                    'action' => ['register','login'],
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

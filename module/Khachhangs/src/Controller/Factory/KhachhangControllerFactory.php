<?php
namespace Khachhangs\Controller\Factory;
use Interop\Container\ContainerInterface;
use KhachHangs\Controller\KhachHangController;
use Khachhangs\Controller\KhachhangController as ControllerKhachhangController;
use KhachHangs\Service\KhachHangsManager;
use Khachhangs\Service\KhachhangsManager as ServiceKhachhangsManager;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceManager;
use Users\Service\UserManager;
use Users\Controller\UserController;
use Users\Service\UsersManager;

class KhachhangControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');   
        $khManager = $container->get(ServiceKhachhangsManager::class);

        return new ControllerKhachhangController($entityManager,$khManager);
    }
}

?>
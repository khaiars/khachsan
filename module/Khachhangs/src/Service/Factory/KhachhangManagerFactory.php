<?php
namespace Khachhangs\Service\Factory;

use Interop\Container\ContainerInterface;
use KhachHangs\Service\KhachHangsManager;
use Khachhangs\Service\KhachhangsManager as ServiceKhachhangsManager;
use Laminas\ServiceManager\Factory\FactoryInterface as FactoryFactoryInterface;

class KhachhangManagerFactory implements FactoryFactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
           
        return new ServiceKhachhangsManager($entityManager);
    }   
}

?>
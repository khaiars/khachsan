<?php
namespace Dkdps\Service\Factory;

use DangKyDatPhongs\Service\DangKyDatPhongManager;
use DangKyDatPhongs\Service\DangKyDatPhongsManager;
use Dkdps\Service\DkdpManager;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface as FactoryFactoryInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceManager;
use Users\Service\UsersManager;

class DkdpManagerFactory implements FactoryFactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
           
        return new DkdpManager($entityManager);
    }   
}

?>
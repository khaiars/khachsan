<?php
namespace Dkdps\Controller\Factory;

use DangKyDatPhongs\Controller\DangKyDatPhongController;
use DangKyDatPhongs\Service\DangKyDatPhongManager;
use DangKyDatPhongs\Service\DangKyDatPhongsManager;
use Dkdps\Controller\DkdpController;
use Dkdps\Service\DkdpManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceManager;
use Users\Service\UserManager;
use Users\Controller\UserController;
use Users\Service\UsersManager;

class DkdpControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');   
        $dankydatphongManager = $container->get(DkdpManager::class);

        return new DkdpController($entityManager,$dankydatphongManager);
    }
}

?>
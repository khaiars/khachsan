<?php
namespace Loaiphong\Controller\Factory;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface as FactoryFactoryInterface;
use Laminas\ServiceManager\FactoryInterface as ServiceManagerFactoryInterface;
use Loaiphong\Controller\LoaiphongController as ControllerLoaiphongController;
use Loaiphong\Service\LoaiphongsManager as ServiceLoaiphongsManager;
use Loaiphongs\Controller\LoaiPhongController;
use Loaiphongs\Service\LoaiPhongsManager;
use Phongs\Controller\PhongController;
use LoaiPhongs\Service\PhongsManager;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceManager;

class LoaiphongControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');   
        $loaiphongManager = $container->get(ServiceLoaiphongsManager::class);

        return new ControllerLoaiphongController($entityManager,$loaiphongManager);
    }
}

?>
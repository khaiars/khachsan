<?php
namespace Khachsan\Service\Factory;

use Interop\Container\ContainerInterface;
use Khachsan\Service\KhachsanManager;
use Laminas\ServiceManager\Factory\FactoryInterface as FactoryFactoryInterface;
use Loaiphong\Service\LoaiphongsManager ;


class KhachsanManagerFactory implements FactoryFactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
           
        return new KhachsanManager($entityManager);
    }   
}

?>
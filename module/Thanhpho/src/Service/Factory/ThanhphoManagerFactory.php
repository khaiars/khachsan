<?php
namespace Thanhpho\Service\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface as FactoryFactoryInterface;
use Loaiphong\Service\LoaiphongsManager ;
use Thanhpho\Service\ThanhphoManager;

class ThanhphoManagerFactory implements FactoryFactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
           
        return new ThanhphoManager($entityManager);
    }   
}

?>
<?php
namespace Users\Controller\Factory;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface as FactoryFactoryInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceManager;
use Users\Service\UserManager;
use Users\Controller\UserController;
use Users\Service\UsersManager;

class UserControllerFactory implements FactoryFactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');   
        $userManager = $container->get(UserManager::class);

        return new UserController($entityManager,$userManager);
    }
}

?>
<?php
namespace Users\Service\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Authentication\AuthenticationService;
use Interop\Container\ContainerInterface;
use Laminas\Authentication\Storage\Session;
use Users\Service\AuthAdapter;
use Laminas\Session\SessionManager; 

class AuthenticationServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $authAdapter = $container->get(AuthAdapter::class);
        $sessionManager =$container->get(SessionManager::class);
        $authStorage = new Session("Zend_Auth","session",$sessionManager);       
        return new AuthenticationService($authStorage,$authAdapter);
    }
}
?>
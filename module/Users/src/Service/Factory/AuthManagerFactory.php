<?php
namespace Users\Service\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Authentication\AuthenticationService;
use Users\Service\AuthManager;
use Interop\Container\ContainerInterface;
use Laminas\Session\SessionManager;
use Users\Service\UserManager;

class AuthManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $authenticationService = $container->get(AuthenticationService::class);
        $sessionManager =$container->get(SessionManager::class);
      //  $userManager = $container->get(UserManager::class);  

        $config = $container->get('Config');
        if(isset($config['access_filter'])){
            $config = $config['access_filter'];
        }
        else
        {
            $config = [];
        }

        return new AuthManager($authenticationService,$sessionManager,$config);
        
    }   

}
?>
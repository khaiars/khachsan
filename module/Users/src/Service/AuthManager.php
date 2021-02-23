<?php

namespace Users\Service;

use Laminas\Authentication\Result;



class AuthManager
{
    private $authenticationService;
    private $sessionManager;
    private $config;
    

    

    public function __construct($authenticationService, $sessionManager, $config )
    {
        $this->authenticationService = $authenticationService;
        $this->sessionManager = $sessionManager;
        $this->config = $config;
        
    }

    // public function checkLogged()
    // {
    //     if ($this->authenticationService->hasIdentity()) {
    //         return true;
    //     }
    //     return false;
    // }

    public function login($username, $password)
    {
        if ($this->authenticationService->hasIdentity()) {
            throw new \Exception("Bạn đã đăng nhập");
        }

        $authAdapter = $this->authenticationService->getAdapter();
        $authAdapter->setUsername($username);
        $authAdapter->setPassword($password);

        $result = $this->authenticationService->authenticate();
        if ($result->getCode() == Result::SUCCESS) {
            $this->sessionManager->rememberMe(86400);
        }

        return $result;
    }
    public function logout()
    {
        if ($this->authenticationService->hasIdentity()) {
            $this->authenticationService->clearIdentity();
        } 
    }
    public function filterAccess($controllerName,$actionName)
    {
        if (isset($this->config['controllers'][$controllerName])) {
            $controllers = $this->config['controllers'][$controllerName];
            foreach ($controllers as $controller) {
                $listAction = $controller['action'];
                $allow = $controller['allow'];
                if (in_array($actionName, $listAction)) {
                    if ($allow == "all") {
                        // duoc phep truy cap voi bat ky ai
                        return true;
                    } 
                    elseif ($allow == "limit" && $this->authenticationService->hasIdentity()) 
                    {
                        // phai login moi duoc truy cap
                        return true;
                    } 
                    else return false;
                }
            }
        }
        else{
            if(!$this->authenticationService->hasIdentity()){
                return false;
            }
        
        }
        return true;
    }
}

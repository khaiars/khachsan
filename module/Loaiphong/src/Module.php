<?php


namespace Loaiphong;

class Module
{
    const VERSION = '3.1.4dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    public function getAutoloaderConfig()
    {
        return[
            'Zend\Loader\StandardAutoloader'=>[
                'namespace'=>[
                    __NAMESPACE__ =>__DIR__.'/src/'.__NAMESPACE__
                ]
            ]
        ];        
    }
}
?>

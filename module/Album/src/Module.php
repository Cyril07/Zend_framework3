<?php

namespace Album;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    // public function getServiceConfig()
    // {
    //     return [
            
    //     ];
    // }

    // public function getControllerConfig()
    // {
    //     return [
            
    //     ];
    // }


}
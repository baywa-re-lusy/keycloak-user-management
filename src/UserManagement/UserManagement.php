<?php

namespace BayWaReLusy\UserManagement;

use Laminas\ServiceManager\ServiceManager;

class UserManagement extends ServiceManager
{
    public function __construct(UserManagementConfig $config)
    {
        $services = require __DIR__ . '/../../config/module.config.php';
        parent::__construct($services['service_manager']);

        $this->setService(UserManagementConfig::class, $config);
    }
}

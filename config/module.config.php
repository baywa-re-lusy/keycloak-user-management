<?php

use BayWaReLusy\UserManagement\UserService;
use BayWaReLusy\UserManagement\UserService\KeycloakAdapter;
use BayWaReLusy\UserManagement\UserService\KeycloakAdapterFactory;

return [
    'service_manager' =>
        [
            'invokables' =>
                [
                    UserService::class
                ],
            'factories' =>
                [
                    KeycloakAdapter::class => KeycloakAdapterFactory::class
                ],
            'abstract_factories' =>
                [
                ],
            'initializers' =>
                [
                ],
            'shared' =>
                [
                ]
        ]
];

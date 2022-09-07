BayWa r.e. Keycloak User Management
===================================

[![CircleCI](https://dl.circleci.com/status-badge/img/gh/baywa-re-lusy/user-management/tree/main.svg?style=svg)](https://dl.circleci.com/status-badge/redirect/gh/baywa-re-lusy/user-management/tree/main)
## Installation

To install the User Management tools, you will need [Composer](http://getcomposer.org/) in your project:

```bash
composer require baywa-re-lusy/user-management
```

## Usage

Currently, this library only supports Keycloak. However it uses an Adapter pattern to allow adding other vendors easily.

```php
use BayWaReLusy\UserManagement\UserManagementConfig;
use BayWaReLusy\UserManagement\UserManagement;
use BayWaReLusy\UserManagement\UserService;
use BayWaReLusy\UserManagement\UserService\KeycloakAdapter;

$userManagementConfig = new UserManagementConfig(
    'https://auth-server-address',
    '/token-endpoint',
    '/users-endpoint',
    '/logout-endpoint',
    'client-credentials-client-id',
    'client-credentials-client-secret',
    'uuid-of-frontend-client'
);
$userManagement = new UserManagement($userManagementConfig);
$userService    = $userManagement->get(UserService::class);
$userService->setAdapter($userManagement->get(KeycloakAdapter::class));
```

Optionally, you can include then the User Management Client into your Service Manager:

```php
$sm->setService(UserManagement::class, $userManagement);
```

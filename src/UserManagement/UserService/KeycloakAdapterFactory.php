<?php

namespace BayWaReLusy\UserManagement\UserService;

use BayWaReLusy\UserManagement\UserManagementConfig;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use GuzzleHttp\Client as HttpClient;

/**
 * Describes what an Identity Provider must provide.
 */
class KeycloakAdapterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        /** @var UserManagementConfig $config */
        $config = $container->get(UserManagementConfig::class);

        return new KeycloakAdapter(
            new HttpClient(['base_uri' => $config->getServerUrl()]),
            $config->getTokenEndpoint(),
            $config->getUsersEndpoint(),
            $config->getManagementApiClientId(),
            $config->getManagementApiClientSecret(),
            $config->getFrontendClientUuid()
        );
    }
}

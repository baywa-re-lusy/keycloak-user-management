<?php

namespace BayWaReLusy\UserManagement\UserService;

use GuzzleHttp\Client as HttpClient;

/**
 * Describes what an Identity Provider must provide.
 */
class KeycloakAdapter implements IdentityProviderAdapterInterface
{
    public function __construct(
        protected HttpClient $httpClient,
        protected string $tokenEndpoint,
        protected string $usersEndpoint
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function getAllUsers(): array
    {
        $response = $this->httpClient->post($this->tokenEndpoint);

        var_dump($response);

        return [];
    }
}

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
        protected string $usersEndpoint,
        protected string $managementApiClientId,
        protected string $managementApiClientSecret
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function getAllUsers(): array
    {
        $params = [
            'verify'      => false,
            'http_errors' => false,
            'headers'     =>
                [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Accept'       => 'application/json'
                ],
            'form_params' =>
                [
                    'grant_type'    => 'client_credentials',
                    'client_id'     => $this->managementApiClientId,
                    'client_secret' => $this->managementApiClientSecret,
                ]
        ];

        $response = $this->httpClient->post($this->tokenEndpoint, $params);

        var_dump($response->getBody());

        return [];
    }
}

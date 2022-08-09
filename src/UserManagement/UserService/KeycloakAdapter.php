<?php

namespace BayWaReLusy\UserManagement\UserService;

use BayWaReLusy\UserManagement\UserEntity;
use BayWaReLusy\UserManagement\UserManagementException;
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
        $response = json_decode($response->getBody()->getContents(), true);

        if (!is_array($response) || !array_key_exists('access_token', $response)) {
            throw new UserManagementException("Couldn't get a Token from Authentication Server.");
        }

        $params = [
            'http_errors' => false,
            'headers'     =>
                [
                    'Authorization' => sprintf("Bearer %s", $response['access_token']),
                    'Accept'        => 'application/json',
                ],
        ];

        $response = $this->httpClient->get($this->usersEndpoint, $params);
        $response = json_decode($response->getBody()->getContents(), true);
        $users    = [];

        foreach ($response as $userData) {
            if (!array_key_exists('email', $userData)) {
                continue;
            }

            $user = new UserEntity();
            $user
                ->setId($userData['id'])
                ->setNickname($userData['username'])
                ->setUsername($userData['username'])
                ->setEmailVerified($userData['emailVerified'])
                ->setEmail($userData['email'])
                ->setName($userData['email'])
                ->setCreated(\DateTime::createFromFormat('U', round($userData['createdTimestamp']/1000)));
//                ->setPicture($auth0User['picture'])
//                ->setLastUpdate($lastUpdate ?: null)
//                ->setLastLogin($lastLogin ?: null);

            $users[] = $user;
        }

        return $users;
    }
}

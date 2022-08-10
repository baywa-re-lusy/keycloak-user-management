<?php

namespace BayWaReLusy\UserManagement\UserService;

use BayWaReLusy\UserManagement\UserEntity;
use BayWaReLusy\UserManagement\UserManagementException;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Describes what an Identity Provider must provide.
 */
class KeycloakAdapter implements IdentityProviderAdapterInterface
{
    protected string $accessToken;

    public function __construct(
        protected HttpClient $httpClient,
        protected string $tokenEndpoint,
        protected string $usersEndpoint,
        protected string $managementApiClientId,
        protected string $managementApiClientSecret,
        protected string $frontendClientUuid
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

        $this->accessToken = $response['access_token'];

        $params = [
            'http_errors' => false,
            'headers'     =>
                [
                    'Authorization' => sprintf("Bearer %s", $this->accessToken),
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

            $this->getUserRoles($user);

            $users[] = $user;
        }

        return $users;
    }

    /**
     * Retrieve and inject the users roles.
     *
     * @param UserEntity $user
     * @return void
     * @throws UserManagementException
     */
    protected function getUserRoles(UserEntity $user): void
    {
        $params = [
            'http_errors' => false,
            'headers'     =>
                [
                    'Authorization' => sprintf("Bearer %s", $this->accessToken),
                    'Accept'        => 'application/json',
                ],
        ];

        try {
            $response = $this->httpClient->get(
                sprintf("/admin/realms/master/users/%s/role-mappings/clients/%s", $user->getId(), $this->frontendClientUuid),
                $params
            );
        } catch (ClientException|GuzzleException $e) {
            throw new UserManagementException("Couldn't fetch roles for user.");
        }

        $response = json_decode($response->getBody()->getContents(), true);

        foreach ($response as $roleData) {
            $user->addRole($roleData['name']);
        }
    }
}

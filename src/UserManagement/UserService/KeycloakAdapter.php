<?php

namespace BayWaReLusy\UserManagement\UserService;

use BayWaReLusy\UserManagement\UserEntity;
use BayWaReLusy\UserManagement\UserManagementException;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Describes what an Identity Provider must provide.
 */
class KeycloakAdapter implements IdentityProviderAdapterInterface
{
    protected ?string $accessToken = null;

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
        $this->loginToAuthServer();

        // Get the list of users from Auth Server
        $params = [
            'http_errors' => false,
            'headers'     =>
                [
                    'Authorization' => sprintf("Bearer %s", $this->accessToken),
                    'Accept'        => 'application/json',
                ],
        ];

        try {
            $response = $this->httpClient->get($this->usersEndpoint, $params);
        } catch (GuzzleException $e) {
            throw new UserManagementException("Couldn't get the list of users from Authentication Server.");
        }

        $response = json_decode($response->getBody()->getContents(), true);
        $users    = [];

        foreach ($response as $userData) {
            // Skip users without email address (M2M users)
            if (!array_key_exists('email', $userData)) {
                continue;
            }

            // Skip users without valid creation date
            if (
                !array_key_exists('createdTimestamp', $userData) ||
                !is_int($userData['createdTimestamp']) ||
                !$created = \DateTime::createFromFormat('U', (string)round($userData['createdTimestamp'] / 1000))
            ) {
                continue;
            }

            // Skip disabled users
            if (false === $userData['enabled']) {
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
                ->setCreated($created);
//                ->setPicture($auth0User['picture'])
//                ->setLastUpdate($lastUpdate ?: null)
//                ->setLastLogin($lastLogin ?: null);

            $this->getUserRoles($user);

            $users[] = $user;
        }

        return $users;
    }

    /**
     * {@inheritdoc}
     */
    public function logout(UserEntity $user): void
    {
        $this->loginToAuthServer();

        // Get the list of users from Auth Server
        $params = [
            'http_errors' => false,
            'headers'     =>
                [
                    'Authorization' => sprintf("Bearer %s", $this->accessToken),
                    'Accept'        => 'application/json',
                ],
        ];

        try {
            $response = $this->httpClient->post(sprintf("/admin/realms/master/users/%s/logout", $user->getId()), $params);
        } catch (GuzzleException $e) {
            throw new UserManagementException("Couldn't log out the user.");
        }
    }

    protected function loginToAuthServer(): void
    {
        if (!is_null($this->accessToken)) {
            return;
        }

        // Get a token from Auth Server
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

        try {
            $response = $this->httpClient->post($this->tokenEndpoint, $params);
        } catch (GuzzleException $e) {
            throw new UserManagementException("Couldn't get a Token from Authentication Server.");
        }

        $response = json_decode($response->getBody()->getContents(), true);

        if (!is_array($response) || !array_key_exists('access_token', $response)) {
            throw new UserManagementException("Invalid response from Authentication Server.");
        }

        $this->accessToken = $response['access_token'];
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
                sprintf(
                    "/admin/realms/master/users/%s/role-mappings/clients/%s",
                    $user->getId(),
                    $this->frontendClientUuid
                ),
                $params
            );
        } catch (GuzzleException $e) {
            throw new UserManagementException("Couldn't fetch roles for user.");
        }

        $response = json_decode($response->getBody()->getContents(), true);

        foreach ($response as $roleData) {
            $user->addRole($roleData['name']);
        }
    }
}

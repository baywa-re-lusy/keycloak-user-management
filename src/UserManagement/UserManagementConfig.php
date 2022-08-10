<?php

namespace BayWaReLusy\UserManagement;

class UserManagementConfig
{
    public function __construct(
        protected string $serverAddress,
        protected string $tokenEndpoint,
        protected string $usersEndpoint,
        protected string $managementApiClientId,
        protected string $managementApiClientSecret,
        protected string $frontendClientUuid
    ) {
    }

    /**
     * @return string
     */
    public function getServerAddress(): string
    {
        return $this->serverAddress;
    }

    /**
     * @return string
     */
    public function getTokenEndpoint(): string
    {
        return $this->tokenEndpoint;
    }

    /**
     * @return string
     */
    public function getUsersEndpoint(): string
    {
        return $this->usersEndpoint;
    }

    /**
     * @return string
     */
    public function getManagementApiClientId(): string
    {
        return $this->managementApiClientId;
    }

    /**
     * @return string
     */
    public function getManagementApiClientSecret(): string
    {
        return $this->managementApiClientSecret;
    }

    /**
     * @return string
     */
    public function getFrontendClientUuid(): string
    {
        return $this->frontendClientUuid;
    }
}

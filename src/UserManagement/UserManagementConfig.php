<?php

namespace BayWaReLusy\UserManagement;

class UserManagementConfig
{
    public function __construct(
        protected string $serverUrl,
        protected string $tokenEndpoint,
        protected string $usersEndpoint,
        protected string $realm
    ) {
    }

    /**
     * @return string
     */
    public function getServerUrl(): string
    {
        return $this->serverUrl;
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
    public function getRealm(): string
    {
        return $this->realm;
    }
}

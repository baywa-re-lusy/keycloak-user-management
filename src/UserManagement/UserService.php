<?php

namespace BayWaReLusy\UserManagement;

use BayWaReLusy\UserManagement\UserService\IdentityProviderAdapterInterface;

class UserService
{
    /**
     * @param IdentityProviderAdapterInterface $adapter
     */
    public function __construct(
        protected IdentityProviderAdapterInterface $adapter
    ) {}

    /**
     * Get the list of users.
     * @return UserEntity[]
     */
    public function getAllUsers(): array
    {
        return $this->adapter->getAllUsers();
    }
}

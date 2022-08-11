<?php

namespace BayWaReLusy\UserManagement;

use BayWaReLusy\UserManagement\UserService\IdentityProviderAdapterInterface;

class UserService
{
    protected IdentityProviderAdapterInterface $adapter;

    /**
     * @param IdentityProviderAdapterInterface $adapter
     * @return UserService
     */
    public function setAdapter(IdentityProviderAdapterInterface $adapter): UserService
    {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * Get the list of users.
     * @return UserEntity[]
     * @throws UserManagementException
     */
    public function getAllUsers(): array
    {
        return $this->adapter->getAllUsers();
    }
}

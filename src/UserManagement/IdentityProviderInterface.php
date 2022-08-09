<?php

namespace BayWaReLusy\UserManagement;

/**
 * Describes what an Identity Provider must provide.
 */
interface IdentityProviderInterface
{
    /**
     * Get all users from the Identity Provider hydrated into a UserEntity array.
     * @return UserEntity[]
     */
    public function getAllUsers(): array;
}

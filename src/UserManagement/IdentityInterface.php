<?php

namespace BayWaReLusy\UserManagement;

use Laminas\Permissions\Acl\Role\RoleInterface;

interface IdentityInterface extends RoleInterface
{
    /**
     * Return true/false whether the user has the given scope or not.
     * @param string $scope
     * @return bool
     */
    public function hasScope(string $scope): bool;

    /**
     * Add a scope to the user.
     * @param string $scope
     * @return IdentityInterface
     */
    public function addScope(string $scope): IdentityInterface;

    /**
     * Get the list of Scopes.
     * @return string[]
     */
    public function getScopes(): array;

    /**
     * Set the list of scopes.
     * @param string[] $scopes
     * @return IdentityInterface
     */
    public function setScopes(array $scopes): IdentityInterface;

    /**
     * Add a role to the user.
     * @param string $role
     * @return IdentityInterface
     */
    public function addRole(string $role): IdentityInterface;

    /**
     * Get the list of Roles.
     * @return string[]
     */
    public function getRoles(): array;

    /**
     * Set the list of roles.
     * @param string[] $roles
     * @return IdentityInterface
     */
    public function setRoles(array $roles): IdentityInterface;
}

<?php

namespace BayWaReLusy\UserManagement;

use Laminas\Permissions\Acl\Role\RoleInterface;

interface IdentityInterface extends RoleInterface
{
    /**
     * Return true/false whether the user has the given permission or not.
     * @param string $permission
     * @return bool
     */
    public function hasPermission(string $permission): bool;

    /**
     * Add a permission to the user.
     * @param string $permission
     * @return IdentityInterface
     */
    public function addPermission(string $permission): IdentityInterface;

    /**
     * Get the list of Permissions.
     * @return string[]
     */
    public function getPermissions(): array;

    /**
     * Set the list of permissions.
     * @param string[] $permissions
     * @return IdentityInterface
     */
    public function setPermissions(array $permissions): IdentityInterface;

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

<?php

namespace BayWaReLusy\UserManagement;

trait IdentityTrait
{
    /** @var string[] */
    protected array $permissions = [];

    /** @var string[] */
    protected array $roles = [];

    /**
     * {@inheritdoc}
     */
    public function hasPermission(string $permission): bool
    {
        return in_array($permission, $this->permissions);
    }

    /**
     * {@inheritdoc}
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }

    /**
     * {@inheritdoc}
     */
    public function setPermissions(array $permissions): IdentityInterface
    {
        $this->permissions = $permissions;
        return $this;
    }

    public function addPermission(string $permission): IdentityInterface
    {
        if (!in_array($permission, $this->permissions)) {
            $this->permissions[] = $permission;
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * {@inheritdoc}
     */
    public function setRoles(array $roles): IdentityInterface
    {
        $this->roles = $roles;
        return $this;
    }

    public function addRole(string $role): IdentityInterface
    {
        if (!in_array($role, $this->roles)) {
            $this->roles[] = $role;
        }

        return $this;
    }
}

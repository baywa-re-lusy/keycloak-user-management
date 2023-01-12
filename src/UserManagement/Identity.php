<?php

namespace BayWaReLusy\UserManagement;

use BayWaReLusy\JwtAuthentication\Token;

/**
 * Class Identity
 * @OA\Schema()
 */
class Identity extends UserEntity
{
    /** @var string[] */
    protected array $scopes = [];

    /** @var string[] */
    protected array $roles = [];

    /**
     * @param string $scope
     * @return bool
     */
    public function hasScope(string $scope): bool
    {
        return in_array($scope, $this->scopes);
    }

    /**
     * @return string[]
     */
    public function getScopes(): array
    {
        return $this->scopes;
    }

    /**
     * @param string[] $scopes
     * @return IdentityInterface
     */
    public function setScopes(array $scopes): IdentityInterface
    {
        $this->scopes = $scopes;
        return $this;
    }

    /**
     * @param string $scope
     * @return IdentityInterface
     */
    public function addScope(string $scope): IdentityInterface
    {
        if (!in_array($scope, $this->scopes)) {
            $this->scopes[] = $scope;
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

    public static function createFromJWT(Token $jwtToken): Identity
    {
        $identity = new Identity();
        $identity
            ->setId($jwtToken->getSub())
            ->setUsername($jwtToken->getUsername())
            ->setEmailVerified($jwtToken->getEmailVerified())
            ->setEmail($jwtToken->getEmail())
            ->setRoles($jwtToken->getRoles())
            ->setScopes($jwtToken->getScopes());

        return $identity;
    }
}

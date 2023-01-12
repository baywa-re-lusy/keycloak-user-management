<?php

namespace BayWaReLusy\UserManagement;

trait IdentityTrait
{
    /** @var string[] */
    protected array $scopes = [];

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
}

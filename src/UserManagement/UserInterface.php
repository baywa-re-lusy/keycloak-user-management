<?php

namespace BayWaReLusy\UserManagement;

interface UserInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @param string $id
     * @return UserInterface
     */
    public function setId(string $id): UserInterface;

    /**
     * @return string
     */
    public function getUsername(): string;

    /**
     * @param string $username
     * @return UserEntity
     */
    public function setUsername(string $username): UserEntity;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @param string $email
     * @return UserEntity
     */
    public function setEmail(string $email): UserEntity;

    /**
     * @return bool
     */
    public function getEmailVerified(): bool;

    /**
     * @param bool $emailVerified
     * @return UserEntity
     */
    public function setEmailVerified(bool $emailVerified): UserEntity;

    /**
     * @return \DateTime|null
     */
    public function getCreated(): ?\DateTime;

    /**
     * @param \DateTime|null $created
     * @return UserEntity
     */
    public function setCreated(?\DateTime $created): UserEntity;

    /**
     * @return string[]
     */
    public function getRoles(): array;

    /**
     * @param string[] $roles
     * @return UserEntity
     */
    public function setRoles(array $roles): UserEntity;

    /**
     * @param string $role
     * @return UserEntity
     */
    public function addRole(string $role): UserEntity;
}

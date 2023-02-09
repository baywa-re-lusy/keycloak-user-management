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
     * @return UserInterface
     */
    public function setUsername(string $username): UserInterface;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @param string $email
     * @return UserInterface
     */
    public function setEmail(string $email): UserInterface;

    /**
     * @return bool
     */
    public function getEmailVerified(): bool;

    /**
     * @param bool $emailVerified
     * @return UserInterface
     */
    public function setEmailVerified(bool $emailVerified): UserInterface;

    /**
     * @return \DateTime|null
     */
    public function getCreated(): ?\DateTime;

    /**
     * @param \DateTime|null $created
     * @return UserInterface
     */
    public function setCreated(?\DateTime $created): UserInterface;

    /**
     * @return string[]
     */
    public function getRoles(): array;

    /**
     * @param string[] $roles
     * @return UserInterface
     */
    public function setRoles(array $roles): UserInterface;

    /**
     * @param string $role
     * @return UserInterface
     */
    public function addRole(string $role): UserInterface;
}

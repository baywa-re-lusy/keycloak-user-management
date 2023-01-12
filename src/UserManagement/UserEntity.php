<?php

namespace BayWaReLusy\UserManagement;

use BayWaReLusy\JwtAuthentication\Token;

/**
 * Class UserEntity
 * @OA\Schema()
 */
class UserEntity
{
    /**
     * @var string
     *
     * @OA\Property(
     *     description="The User ID",
     *     type="string",
     *     example="5f95f0ed78f4b00076854586"
     * )
     */
    protected string $id;

    /**
     * @var string
     *
     * @OA\Property(
     *     description="The username",
     *     type="string",
     *     example="pascal.paulis"
     * )
     */
    protected string $username;

    /**
     * @var string
     *
     * @OA\Property(
     *     description="The Email address",
     *     type="string",
     *     example="pascal.paulis@baywa-re.com"
     * )
     */
    protected string $email;

    protected bool $emailVerified;

    protected ?\DateTime $created;

    public static function createFromJWT(Token $jwtToken): UserEntity
    {
        $user = new UserEntity();
        $user
            ->setId($jwtToken->getSub())
            ->setUsername($jwtToken->getUsername())
            ->setEmailVerified($jwtToken->getEmailVerified())
            ->setEmail($jwtToken->getEmail())
            ->setRoles($jwtToken->getRoles())
            ->setScopes($jwtToken->getScopes());

        return $user;
    }

    public function getRoleId()
    {
        return 'user_' . $this->getId();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return UserEntity
     */
    public function setId(string $id): UserEntity
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return UserEntity
     */
    public function setUsername(string $username): UserEntity
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return UserEntity
     */
    public function setEmail(string $email): UserEntity
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return bool
     */
    public function getEmailVerified(): bool
    {
        return $this->emailVerified;
    }

    /**
     * @param bool $emailVerified
     * @return UserEntity
     */
    public function setEmailVerified(bool $emailVerified): UserEntity
    {
        $this->emailVerified = $emailVerified;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreated(): ?\DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime|null $created
     * @return UserEntity
     */
    public function setCreated(?\DateTime $created): UserEntity
    {
        $this->created = $created;
        return $this;
    }
}

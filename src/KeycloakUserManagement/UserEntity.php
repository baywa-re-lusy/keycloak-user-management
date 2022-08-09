<?php

namespace Application\User;

use tms\ArraySerializableTrait;
use tms\DbEntityInterface;

/**
 * Class UserEntity
 * @package Application\User
 *
 * @OA\Schema()
 */
class UserEntity implements DbEntityInterface, IdentityInterface
{
    use IdentityTrait;
    use ArraySerializableTrait;

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
     *     description="The Username (email)",
     *     type="string",
     *     example="pascal.paulis@baywa-re.com"
     * )
     */
    protected string $name;

    /**
     * @var string
     *
     * @OA\Property(
     *     description="The nickname",
     *     type="string",
     *     example="pascal.paulis"
     * )
     */
    protected string $nickname;

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
    protected string $picture;
    protected ?\DateTime $created;
    protected ?\DateTime $lastUpdate;
    protected ?\DateTime $lastLogin;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return UserEntity
     */
    public function setName(string $name): UserEntity
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @param string $nickname
     * @return UserEntity
     */
    public function setNickname(string $nickname): UserEntity
    {
        $this->nickname = $nickname;
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
     * @return string
     */
    public function getPicture(): string
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     * @return UserEntity
     */
    public function setPicture(string $picture): UserEntity
    {
        $this->picture = $picture;
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

    /**
     * @return \DateTime|null
     */
    public function getLastUpdate(): ?\DateTime
    {
        return $this->lastUpdate;
    }

    /**
     * @param \DateTime|null $lastUpdate
     * @return UserEntity
     */
    public function setLastUpdate(?\DateTime $lastUpdate): UserEntity
    {
        $this->lastUpdate = $lastUpdate;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getLastLogin(): ?\DateTime
    {
        return $this->lastLogin;
    }

    /**
     * @param \DateTime|null $lastLogin
     * @return UserEntity
     */
    public function setLastLogin(?\DateTime $lastLogin): UserEntity
    {
        $this->lastLogin = $lastLogin;
        return $this;
    }
}

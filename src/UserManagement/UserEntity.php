<?php

namespace BayWaReLusy\UserManagement;

/**
 * Class UserEntity
 * @package Application\User
 *
 * @OA\Schema()
 */
class UserEntity implements IdentityInterface
{
    use IdentityTrait;

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
     * @deprecated
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
     * @deprecated Will be replaced by $username
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

    /**
     * @var string|null
     * @deprecated
     */
    protected ?string $picture = null;
    protected ?\DateTime $created;

    /**
     * @var \DateTime|null
     * @deprecated
     */
    protected ?\DateTime $lastUpdate = null;

    /**
     * @var \DateTime|null
     * @deprecated
     */
    protected ?\DateTime $lastLogin = null;

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
     * @deprecated
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return UserEntity
     * @deprecated
     */
    public function setName(string $name): UserEntity
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     * @deprecated Will be replaced by getUsername()
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @param string $nickname
     * @return UserEntity
     * @deprecated Will be replaced by setUsername()
     */
    public function setNickname(string $nickname): UserEntity
    {
        $this->nickname = $nickname;
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
     * @return string|null
     * @deprecated
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param string|null $picture
     * @return UserEntity
     * @deprecated
     */
    public function setPicture(?string $picture): UserEntity
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
     * @deprecated
     */
    public function getLastUpdate(): ?\DateTime
    {
        return $this->lastUpdate;
    }

    /**
     * @param \DateTime|null $lastUpdate
     * @return UserEntity
     * @deprecated
     */
    public function setLastUpdate(?\DateTime $lastUpdate): UserEntity
    {
        $this->lastUpdate = $lastUpdate;
        return $this;
    }

    /**
     * @return \DateTime|null
     * @deprecated
     */
    public function getLastLogin(): ?\DateTime
    {
        return $this->lastLogin;
    }

    /**
     * @param \DateTime|null $lastLogin
     * @return UserEntity
     * @deprecated
     */
    public function setLastLogin(?\DateTime $lastLogin): UserEntity
    {
        $this->lastLogin = $lastLogin;
        return $this;
    }
}

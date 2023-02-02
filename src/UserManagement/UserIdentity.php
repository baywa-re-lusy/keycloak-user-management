<?php

namespace BayWaReLusy\UserManagement;

use BayWaReLusy\JwtAuthentication\Token;

/**
 * Class UserIdentity
 * @OA\Schema()
 */
class UserIdentity extends UserEntity implements IdentityInterface
{
    use IdentityTrait;

    /**
     * @return string
     */
    public function getRoleId(): string
    {
        return 'user_' . $this->getId();
    }

    /**
     * @param Token $jwtToken
     * @return UserIdentity
     */
    public static function createFromJWT(Token $jwtToken): UserIdentity
    {
        $identity = new UserIdentity();
        $identity
            ->setId($jwtToken->getSub())
            ->setUsername($jwtToken->getUsername())
            ->setEmailVerified($jwtToken->getEmailVerified())
            ->setEmail($jwtToken->getEmail())
            ->setRoles($jwtToken->getRoles());

        $identity->setScopes($jwtToken->getScopes());

        return $identity;
    }
}

<?php

namespace BayWaReLusy\UserManagement;

/**
 * Class Identity
 * @OA\Schema()
 */
class Identity extends UserEntity implements IdentityInterface
{
    use IdentityTrait;
}

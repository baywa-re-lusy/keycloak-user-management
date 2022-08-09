<?php

namespace BayWaReLusy\UserManagement;

class MachineUserEntity implements IdentityInterface
{
    use IdentityTrait;

    public const CONSOLE_APPLICATION = 'console';

    protected string $applicationId;

    /**
     * @return string
     */
    public function getRoleId()
    {
        return 'm2m_' . $this->getApplicationId();
    }

    /**
     * @return string
     */
    public function getApplicationId(): string
    {
        return $this->applicationId;
    }

    /**
     * @param string $applicationId
     * @return MachineUserEntity
     */
    public function setApplicationId(string $applicationId): MachineUserEntity
    {
        $this->applicationId = $applicationId;
        return $this;
    }
}

<?php

namespace BayWaReLusy\UserManagement;

class MachineUserIdentity implements IdentityInterface
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
     * @return MachineUserIdentity
     */
    public function setApplicationId(string $applicationId): MachineUserIdentity
    {
        $this->applicationId = $applicationId;
        return $this;
    }
}

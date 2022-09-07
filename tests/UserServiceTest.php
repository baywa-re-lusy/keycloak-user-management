<?php

namespace BayWaReLusy\UserManagement\Test;

use BayWaReLusy\UserManagement\UserEntity;
use BayWaReLusy\UserManagement\UserManagementException;
use BayWaReLusy\UserManagement\UserService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use BayWaReLusy\UserManagement\UserService\IdentityProviderAdapterInterface;

class UserServiceTest extends TestCase
{
    protected UserService $instance;
    protected MockObject $adapterMock;

    public function setUp(): void
    {
        $this->adapterMock = $this->createMock(IdentityProviderAdapterInterface::class);

        $this->instance = new UserService();
        $this->instance->setAdapter($this->adapterMock);
    }

    /**
     * Test that the adapter is correctly called.
     * @return void
     * @throws UserManagementException
     */
    public function testGetAllUsers(): void
    {
        $this->adapterMock
            ->expects($this->once())
            ->method('getAllUsers');

        $this->instance->getAllUsers();
    }

    /**
     * Test that UserManagementExceptions are correctly forwarded.
     * @return void
     * @throws UserManagementException
     */
    public function testGetAllUsersThrowsUserManagementException(): void
    {
        $this->adapterMock
            ->expects($this->once())
            ->method('getAllUsers')
            ->willThrowException(new UserManagementException('error'));

        $this->expectException(UserManagementException::class);

        $this->instance->getAllUsers();
    }

    /**
     * Test that the adapter is correctly called.
     * @return void
     * @throws UserManagementException
     */
    public function testLogout(): void
    {
        $user = new UserEntity();

        $this->adapterMock
            ->expects($this->once())
            ->method('logout')
            ->with($user);

        $this->instance->logout($user);
    }
}

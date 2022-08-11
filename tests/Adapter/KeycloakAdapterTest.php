<?php

namespace BayWaReLusy\UserManagement\Test\Adapter;

use BayWaReLusy\UserManagement\UserEntity;
use BayWaReLusy\UserManagement\UserManagementException;
use BayWaReLusy\UserManagement\UserService\KeycloakAdapter;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client as HttpClient;

class KeycloakAdapterTest extends TestCase
{
    protected KeycloakAdapter $instance;
    protected MockHandler $httpClientMockHandler;

    public function setUp(): void
    {
        $this->httpClientMockHandler = new MockHandler();
        $handlerStack = HandlerStack::create($this->httpClientMockHandler);

        $this->instance = new KeycloakAdapter(
            new HttpClient(['handler' => $handlerStack]),
            '/token-endpoint',
            '/users-endpoint',
            'management-api-client-id',
            'management-api-client-secret',
            'frontend-client-uuid'
        );
    }

    /**
     * Test the hydration of users from the Keycloak.
     * Disabled users or users without creation date/email address are successfully skipped.
     *
     * @return void
     * @throws \BayWaReLusy\UserManagement\UserManagementException
     */
    public function testGetAllUsers(): void
    {
        $this->httpClientMockHandler->reset();
        $this->httpClientMockHandler->append(
            new Response(200, [], '{"access_token": "azerty1234"}'),
            new Response(200, [], (string)file_get_contents(__DIR__ . '/users.json')),
            new Response(200, [], (string)file_get_contents(__DIR__ . '/roles1.json')),
            new Response(200, [], (string)file_get_contents(__DIR__ . '/roles2.json'))
        );

        $users = $this->instance->getAllUsers();

        $this->assertIsArray($users);
        $this->assertCount(2, $users);

        $this->assertInstanceOf(UserEntity::class, $users[0]);
        $this->assertEquals('b73949a9-e7d9-465f-9189-1ff8120e90a9', $users[0]->getId());
        $this->assertEquals('maxim.jamar', $users[0]->getUsername());
        $this->assertEquals('maxim.jamar@baywa-re.com', $users[0]->getEmail());
        $this->assertTrue($users[0]->getEmailVerified());
        $this->assertInstanceOf(\DateTimeInterface::class, $users[1]->getCreated());
        $this->assertEquals('2022-08-05T07:14:04+00:00', $users[0]->getCreated()->format(\DateTimeInterface::RFC3339));
        $this->assertEquals(['logistics', 'inbound', 'superuser'], $users[0]->getRoles());

        $this->assertInstanceOf(UserEntity::class, $users[1]);
        $this->assertEquals('650ded82-b199-4878-9c15-b51c5656171d', $users[1]->getId());
        $this->assertEquals('pascal.paulis', $users[1]->getUsername());
        $this->assertEquals('pascal.paulis@baywa-re.com', $users[1]->getEmail());
        $this->assertFalse($users[1]->getEmailVerified());
        $this->assertInstanceOf(\DateTimeInterface::class, $users[1]->getCreated());
        $this->assertEquals('2022-08-02T13:55:22+00:00', $users[1]->getCreated()->format(\DateTimeInterface::RFC3339));
        $this->assertEquals(['logistics', 'inbound'], $users[1]->getRoles());
    }

    /**
     * @return void
     * @throws UserManagementException
     */
    public function testGetAllUsersTokenException(): void
    {
        $this->httpClientMockHandler->reset();
        $this->httpClientMockHandler->append(new ClientException(
            'Error during Token creation.',
            new Request('POST', 'Token request'),
            new Response()
        ));

        $this->expectException(UserManagementException::class);
        $this->instance->getAllUsers();
    }

    /**
     * @return void
     * @throws UserManagementException
     */
    public function testGetAllUsersUserListException(): void
    {
        $this->httpClientMockHandler->reset();
        $this->httpClientMockHandler->append(
            new Response(200, [], '{"access_token": "azerty1234"}'),
            new ClientException(
                'Error during fetch of user list.',
                new Request('GET', 'User list request'),
                new Response()
            )
        );

        $this->expectException(UserManagementException::class);
        $this->instance->getAllUsers();
    }

    /**
     * @return void
     * @throws UserManagementException
     */
    public function testGetAllUsersUserRolesException(): void
    {
        $this->httpClientMockHandler->reset();
        $this->httpClientMockHandler->append(
            new Response(200, [], '{"access_token": "azerty1234"}'),
            new Response(200, [], (string)file_get_contents(__DIR__ . '/users.json')),
            new Response(200, [], (string)file_get_contents(__DIR__ . '/roles1.json')),
            new ClientException(
                'Error during fetch of user list.',
                new Request('GET', 'User roles request'),
                new Response()
            )
        );

        $this->expectException(UserManagementException::class);
        $this->instance->getAllUsers();
    }
}

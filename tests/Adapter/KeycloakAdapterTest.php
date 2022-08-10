<?php

namespace tms\Test\Unit;

use BayWaReLusy\UserManagement\UserService\KeycloakAdapter;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
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

    public function testGetAllUsers(): void
    {
        $this->httpClientMockHandler->append(
            new Response(200, [], '{"access_token": "azerty1234"}'),
            new Response(200, [], file_get_contents(__DIR__ . '/users.json')),
            new Response(200, [], file_get_contents(__DIR__ . '/roles1.json')),
            new Response(200, [], file_get_contents(__DIR__ . '/roles2.json'))
        );

        $users = $this->instance->getAllUsers();
    }
}

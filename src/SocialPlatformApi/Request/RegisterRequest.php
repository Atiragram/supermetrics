<?php

declare(strict_types=1);

namespace App\SocialPlatformApi\Request;

use App\SocialPlatformApi\Response\RegisterResponse;
use GuzzleHttp\Client;

class RegisterRequest extends AbstractSocialPlatformRequest
{
    private const PATH = '/assignment/register';

    private string $clientId;
    private string $email;
    private string $name;

    public function __construct(
        Client $client,
        string $clientId,
        string $email,
        string $name
    ) {
        parent::__construct($client);

        $this->clientId = $clientId;
        $this->email = $email;
        $this->name = $name;
    }

    public function getOptions(): array
    {
        return [
            'json' => [
                'client_id' => $this->clientId,
                'email' => $this->email,
                'name' => $this->name,
            ],
        ];
    }

    public function getUrl(): string
    {
        return self::PATH;
    }

    public function getMethod(): string
    {
        return self::POST;
    }

    public function execute(): RegisterResponse
    {
        return new RegisterResponse($this->executeRequest());
    }
}

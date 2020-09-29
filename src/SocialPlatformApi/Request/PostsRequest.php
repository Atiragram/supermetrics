<?php

declare(strict_types=1);

namespace App\SocialPlatformApi\Request;

use App\SocialPlatformApi\Response\PostsResponse;
use GuzzleHttp\Client;

class PostsRequest extends AbstractSocialPlatformRequest
{
    private const PATH = '/assignment/posts';

    private string $token;
    private int $pageNumber;

    public function __construct(Client $client, string $token, int $pageNumber)
    {
        parent::__construct($client);

        $this->token = $token;
        $this->pageNumber = $pageNumber;
    }

    public function getOptions(): array
    {
        return [
            'query' => [
                'sl_token' => $this->token,
                'page' => $this->pageNumber,
            ],
        ];
    }

    public function getUrl(): string
    {
        return self::PATH;
    }

    public function getMethod(): string
    {
        return self::GET;
    }

    public function execute(): PostsResponse
    {
        return new PostsResponse($this->executeRequest());
    }
}

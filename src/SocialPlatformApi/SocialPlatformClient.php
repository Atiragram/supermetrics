<?php

declare(strict_types=1);

namespace App\SocialPlatformApi;

use App\SocialPlatformApi\Request\PostsRequest;
use App\SocialPlatformApi\Request\RegisterRequest;
use App\SocialPlatformApi\Response\PostsResponse;
use App\SocialPlatformApi\Response\RegisterResponse;
use GuzzleHttp\Client as GuzzleClient;

class SocialPlatformClient
{
    private GuzzleClient $guzzleClient;
    private string $clientId;
    private string $email;
    private string $name;
    private const ACCESS_TOKEN_LIFE_TIME = 3600;

    public function __construct(
        string $baseurl,
        string $clientId,
        string $email,
        string $name
    ) {
        $this->guzzleClient = new GuzzleClient(['base_uri' => $baseurl]);
        $this->clientId = $clientId;
        $this->email = $email;
        $this->name = $name;
    }

    public function getPosts(int $pageNumber): PostsResponse
    {
        return (new PostsRequest(
            $this->guzzleClient,
            $this->getApiToken(),
            $pageNumber
        ))->execute();
    }

    private function register(): RegisterResponse
    {
        return (new RegisterRequest(
            $this->guzzleClient,
            $this->clientId,
            $this->email,
            $this->name
        ))->execute();
    }

    private function getApiToken(): string
    {
        if ($_SESSION['accesstoken'] && time() - $_SESSION['accesstoken_created'] < self::ACCESS_TOKEN_LIFE_TIME) {
            return $_SESSION['accesstoken'];
        } else {
            $token = $this->register()->getToken();
            session_start();
            $_SESSION['accesstoken'] = $token;
            $_SESSION['accesstoken_created'] = time();

            return $token;
        }
    }
}

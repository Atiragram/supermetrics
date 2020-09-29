<?php

declare(strict_types=1);

namespace App\SocialPlatformApi\Request;

use App\Exception\SocialPlatformApiException;
use App\RequestInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractSocialPlatformRequest implements RequestInterface
{
    protected const POST = 'POST';
    protected const GET = 'GET';

    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function executeRequest(): ResponseInterface
    {
        try {
            return $this->client->request(
                $this->getMethod(),
                $this->getUrl(),
                $this->getOptions()
            );
        } catch (ClientException $exception) {
            throw new SocialPlatformApiException(sprintf('Social Platform Api error: %s', $exception->getMessage()));
        }
    }
}

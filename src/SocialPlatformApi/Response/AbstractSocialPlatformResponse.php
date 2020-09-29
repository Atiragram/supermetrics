<?php

declare(strict_types=1);

namespace App\SocialPlatformApi\Response;

use App\ResponseInterface as BaseResponseInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractSocialPlatformResponse implements BaseResponseInterface
{
    protected ResponseInterface $response;
    protected array $data;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        $this->data = json_decode($response->getBody()->__toString(), true);
    }
}

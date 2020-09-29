<?php

declare(strict_types=1);

namespace App\SocialPlatformApi\Response;

class RegisterResponse extends AbstractSocialPlatformResponse
{
    public function getToken(): string
    {
        return $this->data['data']['sl_token'];
    }
}

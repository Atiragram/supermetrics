<?php

declare(strict_types=1);

namespace App;

use App\SocialPlatformApi\SocialPlatformClient;
use function DI\autowire;
use function DI\create;

return [
    SocialPlatformClient::class => create()->constructor(
            (string) $_ENV['SOCIAL_PLATFORM_API_BASE_URL'],
        (string) $_ENV['SOCIAL_PLATFORM_API_CLIENT_ID'],
        (string) $_ENV['SOCIAL_PLATFORM_API_EMAIL'],
        (string) $_ENV['SOCIAL_PLATFORM_API_NAME'],
    ),
    PostsStatisticsFetcher::class => autowire(),
];

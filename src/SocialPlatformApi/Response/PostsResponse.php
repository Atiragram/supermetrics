<?php

declare(strict_types=1);

namespace App\SocialPlatformApi\Response;

use App\Model\Post;
use Psr\Http\Message\ResponseInterface;

class PostsResponse extends AbstractSocialPlatformResponse
{
    private array $posts = [];

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        foreach ($this->data['data']['posts'] as $post) {
            $this->posts[] = new Post(
                new \DateTime($post['created_time']),
                $post['from_id'],
                $post['from_name'],
                mb_strlen($post['message'])
            );
        }
    }

    public function getPage(): int
    {
        return $this->data['data']['page'];
    }

    /**
     * @return array|Post[]
     */
    public function getPosts(): array
    {
        return $this->posts;
    }
}

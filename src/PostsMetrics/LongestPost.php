<?php

declare(strict_types=1);

namespace App\PostsMetrics;

use App\Model\Post;

class LongestPost implements PostMetricInterface
{
    private array $longestPostResult = [];

    public function calculate(Post $post)
    {
        $month = $post->getPostMonth();
        $this->longestPostResult[$month]  = isset($this->longestPostResult[$month])
            ? max($this->longestPostResult[$month], $post->getPostLength())
            : $post->getPostLength();
    }

    public function getResult(): array
    {
        return [
            'Longest post by character length per month' => $this->longestPostResult,
        ];
    }
}
<?php

declare(strict_types=1);

namespace App\PostsMetrics;

use App\Model\Post;

class AveragePostLength implements PostMetricInterface
{
    private array $avgPostLengthResult = [];

    public function calculate(Post $post)
    {
        $month = $post->getPostMonth();
        $this->avgPostLengthResult[$month] = isset($this->avgPostLengthResult[$month])
            ? round(($this->avgPostLengthResult[$month] +  $post->getPostLength()) / 2)
            : $post->getPostLength();
    }

    public function getResult(): array
    {
        return [
            'Average character length of posts per month' => $this->avgPostLengthResult,
        ];
    }
}

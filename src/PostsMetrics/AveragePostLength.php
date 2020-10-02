<?php

declare(strict_types=1);

namespace App\PostsMetrics;

use App\Model\Post;

class AveragePostLength implements PostMetricInterface
{
    private array $avgPostLengthResult = [];
    private array $postsCountPerMonth = [];
    private array $postsLengthPerMonth = [];

    public function calculate(Post $post)
    {
        $month = $post->getPostMonth();
        $this->postsCountPerMonth[$month] = isset($this->postsCountPerMonth[$month])
            ? $this->postsCountPerMonth[$month] + 1
            : 1;
        $this->postsLengthPerMonth[$month] = isset($this->postsLengthPerMonth[$month])
            ? $this->postsLengthPerMonth[$month] + $post->getPostLength()
            : $post->getPostLength();
        $this->avgPostLengthResult[$month] = round($this->postsLengthPerMonth[$month] / $this->postsCountPerMonth[$month]);
    }

    public function getResult(): array
    {
        return [
            'Average character length of posts per month' => $this->avgPostLengthResult,
        ];
    }
}

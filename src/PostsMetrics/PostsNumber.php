<?php

declare(strict_types=1);

namespace App\PostsMetrics;

use App\Model\Post;

class PostsNumber implements PostMetricInterface
{
    private array $postsNumberResult = [];

    public function calculate(Post $post)
    {
        $weekOfYearNumber = $post->getPostWeekNumber();
        $this->postsNumberResult[$weekOfYearNumber] = isset($this->postsNumberResult[$weekOfYearNumber])
            ?  $this->postsNumberResult[$weekOfYearNumber] + 1
            : 1;
    }

    public function getResult(): array
    {
        return [
            'Total posts split by week number' => $this->postsNumberResult,
        ];
    }
}

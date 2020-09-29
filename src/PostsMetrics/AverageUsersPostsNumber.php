<?php

declare(strict_types=1);

namespace App\PostsMetrics;

use App\Model\Post;

class AverageUsersPostsNumber implements PostMetricInterface
{
    private array $avgUserPostsCountResult = [];
    private array $months = [];

    public function calculate(Post $post)
    {
        $month = $post->getPostMonth();
        $userId = $post->getUserId();
        $this->months[$month] = $month;
        $this->userPostsCountResult[$userId] = isset($this->userPostsCountResult[$userId])
            ? $this->userPostsCountResult[$userId] + 1
            : 1;
        $this->avgUserPostsCountResult[$userId] = round($this->userPostsCountResult[$userId] / count($this->months));
    }

    public function getResult(): array
    {
        return [
            'Average number of posts per user per month' => $this->avgUserPostsCountResult,
        ];
    }
}
<?php

declare(strict_types=1);

namespace App\PostsMetrics;

use App\Model\Post;

interface PostMetricInterface
{
    public function getResult(): array;
    public function calculate(Post $post);
}

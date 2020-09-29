<?php

declare(strict_types=1);

namespace App;

use App\Exception\SocialPlatformApiException;
use App\PostsMetrics\AveragePostLength;
use App\PostsMetrics\AverageUsersPostsNumber;
use App\PostsMetrics\LongestPost;
use App\PostsMetrics\PostMetricInterface;
use App\PostsMetrics\PostsNumber;
use App\SocialPlatformApi\SocialPlatformClient;

class PostsStatisticsFetcher
{
    private SocialPlatformClient $client;
    private const POST_METRIC_CLASSES = [
        AveragePostLength::class,
        LongestPost::class,
        PostsNumber::class,
        AverageUsersPostsNumber::class,
    ];

    public function __construct(SocialPlatformClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param array
     *
     * @return array|PostMetricInterface
     */
    private function getMetricsServices(array $postMetricsToCalculate): array
    {
        foreach ($postMetricsToCalculate as $metricServiceClass) {
            $metrics[] = new $metricServiceClass();
        }

        return $metrics ?? [];
    }

    public function getSocialPlatformStatistics(
        int $startPage,
        int $pagesCount,
        array $postMetricsToCalculate = self::POST_METRIC_CLASSES
    ): array {
        $pageNumber = $startPage;
        $metricServices = $this->getMetricsServices($postMetricsToCalculate);

        do {
            try {
                $postsResponse = $this->client->getPosts($pageNumber);
            } catch (SocialPlatformApiException $exception) {
                echo $exception->getMessage();
                exit;
            }

            $posts = $postsResponse->getPosts();

            foreach ($posts as $post) {
                foreach ($metricServices as $metricService) {
                    $metricService->calculate($post);
                }
            }

            $pageNumber++;
        } while ($pageNumber <= $pagesCount);

        foreach ($metricServices as $metricService) {
            $postsStatistics[] = $metricService->getResult();
        }

        return $postsStatistics ?? [];
    }
}

<?php

declare(strict_types = 1);

namespace App;

use DI\ContainerBuilder;
use josegonzalez\Dotenv\Loader;

require __DIR__ . '/../vendor/autoload.php';

(new Loader(__DIR__ . '/../.env'))
    ->parse()
    ->toEnv();

$containerBuilder = new ContainerBuilder();
$containerBuilder->useAutowiring(true);
$containerBuilder->useAnnotations(false);
$containerBuilder->addDefinitions(__DIR__ . '/config.php');;
$container = $containerBuilder->build();

$postsStatisticsFetcher = $container->get(PostsStatisticsFetcher::class);
$postsStatistics = $postsStatisticsFetcher->getSocialPlatformStatistics(1, 10);
echo json_encode($postsStatistics);

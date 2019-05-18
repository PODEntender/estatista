<?php

use Nawarian\JigsawSitemapPlugin\Listener\SitemapListener;
use TightenCo\Jigsaw\Jigsaw;
use PODEntender\Infrastructure\Application\StaticSite\FileProcessing\JigsawPostProcessFilesAfterBuild;
use PODEntender\Infrastructure\Application\StaticSite\FileProcessing\JigsawGenerateRssFeedAfterBuild;
use PODEntender\Infrastructure\Application\StaticSite\JigsawDecoratePagesAfterCollections;
use PODEntender\Infrastructure\Application\StaticSite\GenerateCategoriesAfterCollections;
use PODEntender\Infrastructure\Application\StaticSite\FileProcessing\JigsawGenerateRobotsTxtFileAfterBuild;

/** @var $container \Illuminate\Container\Container */
/** @var $events \TightenCo\Jigsaw\Events\EventBus */

$events->beforeBuild(function (Jigsaw $jigsaw) use ($container) {
    $configureDependencyInjection = require __DIR__ . '/config/dependency-injection.php';
    $configureDependencyInjection($container, $jigsaw);
});

$events->afterCollections([
    JigsawDecoratePagesAfterCollections::class,
    GenerateCategoriesAfterCollections::class,
]);

$events->afterBuild([
    JigsawGenerateRobotsTxtFileAfterBuild::class,
    JigsawPostProcessFilesAfterBuild::class,
    JigsawGenerateRssFeedAfterBuild::class,
    SitemapListener::class,
]);

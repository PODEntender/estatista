<?php

use PODEntender\EventHandler\Category\GenerateCategoriesAfterCollections;

use Nawarian\JigsawSitemapPlugin\Listener\SitemapListener;
use TightenCo\Jigsaw\Jigsaw;
use PODEntender\Infrastructure\Application\StaticSite\FileProcessing\JigsawPostProcessFilesAfterBuild;
use PODEntender\Infrastructure\Application\StaticSite\FileProcessing\JigsawGenerateRssFeedAfterBuild;
use PODEntender\Infrastructure\Application\StaticSite\JigsawDecoratePagesAfterCollect;

/** @var $container \Illuminate\Container\Container */
/** @var $events \TightenCo\Jigsaw\Events\EventBus */

$events->beforeBuild(function (Jigsaw $jigsaw) use ($container) {
    $configureDependencyInjection = require __DIR__ . '/config/dependency-injection.php';
    $configureDependencyInjection($container, $jigsaw);
});

$events->afterCollections([
    $container->make(GenerateCategoriesAfterCollections::class),
    JigsawDecoratePagesAfterCollect::class,
]);

$events->afterBuild([
    JigsawPostProcessFilesAfterBuild::class,
    JigsawGenerateRssFeedAfterBuild::class,
    SitemapListener::class,
]);

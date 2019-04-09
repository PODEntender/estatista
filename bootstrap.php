<?php

use PODEntender\EventHandler\Episode\GenerateRecommendedEpisodeListAfterCollect;
use PODEntender\EventHandler\Episode\DecorateConfigWithEpisodesInformationAfterCollect;
use PODEntender\Infrastructure\Application\Service\FileProcessing\JigsawPostProcessFilesAfterBuild;
use PODEntender\EventHandler\Category\GenerateCategoriesAfterCollections;
use Nawarian\JigsawSitemapPlugin\Listener\SitemapListener;
use PODEntender\Infrastructure\Application\Service\FileProcessing\JigsawGenerateRssFeedAfterBuild;
use TightenCo\Jigsaw\Jigsaw;

/** @var $container \Illuminate\Container\Container */
/** @var $events \TightenCo\Jigsaw\Events\EventBus */

$events->beforeBuild(function (Jigsaw $jigsaw) use ($container) {
    $configureDependencyInjection = require __DIR__ . '/config/dependency-injection.php';
    $configureDependencyInjection($container, $jigsaw);
});

$events->afterCollections([
    $container->make(DecorateConfigWithEpisodesInformationAfterCollect::class),
    $container->make(GenerateRecommendedEpisodeListAfterCollect::class),
    $container->make(GenerateCategoriesAfterCollections::class),
]);

$events->afterBuild([
    JigsawGenerateRssFeedAfterBuild::class,
    JigsawPostProcessFilesAfterBuild::class,
    SitemapListener::class,
]);

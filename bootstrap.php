<?php

use PODEntender\EventHandler\Episode\GenerateRecommendedEpisodeListAfterCollect;
use PODEntender\EventHandler\Episode\DecorateConfigWithEpisodesInformationAfterCollect;
use PODEntender\EventHandler\Episode\PostProcessFilesAfterBuild;
use PODEntender\EventHandler\Category\GenerateCategoriesAfterCollections;
use Nawarian\JigsawSitemapPlugin\Listener\SitemapListener;
use PODEntender\Infrastructure\Application\Service\FileProcessing\JigsawGenerateRssFeed;
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
    JigsawGenerateRssFeed::class,
    SitemapListener::class,
    PostProcessFilesAfterBuild::class,
]);

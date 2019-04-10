<?php

use PODEntender\EventHandler\Episode\GenerateRecommendedEpisodeListAfterCollect;
use PODEntender\EventHandler\Episode\DecorateConfigWithEpisodesInformationAfterCollect;
use PODEntender\Infrastructure\Application\Service\FileProcessing\JigsawPostProcessFilesAfterBuild;
use PODEntender\EventHandler\Category\GenerateCategoriesAfterCollections;
use Nawarian\JigsawSitemapPlugin\Listener\SitemapListener;
use PODEntender\Infrastructure\Application\Service\FileProcessing\JigsawGenerateRssFeedAfterBuild;
use PODEntender\Infrastructure\Domain\Factory\JigsawPostFactory;
use PODEntender\Domain\Service\Post\Recommendation;
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

    // @todo -> move this to a proper handler
    function (Jigsaw $jigsaw) use ($container) {
        $factory = $container->make(JigsawPostFactory::class);
        $recommendationService = $container->make(Recommendation::class);

        $jigsaw
            ->getCollection('episodes')
            ->each(function (\TightenCo\Jigsaw\PageVariable $page) use ($factory, $recommendationService) {
                $postEntity = $factory->newAudioEpisodeFromPageVariable($page);
                $recommendedEpisodes = $recommendationService->recommendEpisodesForPost(
                    $postEntity,
                    3
                );

                $page->postEntity = $postEntity->addRecommendations($recommendedEpisodes);
            });
    },
]);

$events->afterBuild([
    JigsawPostProcessFilesAfterBuild::class,
    JigsawGenerateRssFeedAfterBuild::class,
    SitemapListener::class,
]);

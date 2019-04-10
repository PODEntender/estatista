<?php

namespace PODEntender\Infrastructure\Application\StaticSite;

use PODEntender\Application\Service\Post\FetchRecommendationsForPost;
use PODEntender\Infrastructure\Domain\Factory\JigsawPostFactory;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\PageVariable;

class JigsawDecoratePagesAfterCollect implements JigsawEventHandler
{
    const NUMBER_OF_RECOMMENDED_EPISODES = 3;

    public function handle(Jigsaw $jigsaw): void
    {
        $factory = $jigsaw->app->make(JigsawPostFactory::class);
        $service = $jigsaw->app->make(FetchRecommendationsForPost::class);

        $jigsaw->getCollection('episodes')
            ->each(function (PageVariable $page) use ($factory) {
                $page->audioEpisode = $factory->newAudioEpisodeFromPageVariable($page);
            })
            ->each(function (PageVariable $page) use ($factory, $service) {
                $recommendedEpisodes = $service->execute($page->audioEpisode, self::NUMBER_OF_RECOMMENDED_EPISODES);

                $page->recommendations = $recommendedEpisodes;
            });
    }
}

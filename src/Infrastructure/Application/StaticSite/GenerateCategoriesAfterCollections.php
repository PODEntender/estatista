<?php

namespace PODEntender\Infrastructure\Application\StaticSite;

use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\PageVariable;

class GenerateCategoriesAfterCollections implements JigsawEventHandler
{
    const COLLECTION_NAME_ALL = 'Todos';

    public function handle(Jigsaw $jigsaw): void
    {
        $episodes = $jigsaw->getCollection('episodes');

        $jigsaw->getSiteData()->put(self::COLLECTION_NAME_ALL, $episodes);

        $episodes
            ->groupBy('category')
            ->each(function (PageVariable $episodes, string $category) use ($jigsaw) {
                $jigsaw
                    ->getSiteData()
                    ->put($category, $episodes);
            });
    }
}

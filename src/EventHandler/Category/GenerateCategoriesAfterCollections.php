<?php

namespace PODEntender\EventHandler\Category;

use Illuminate\Support\Collection;
use TightenCo\Jigsaw\Jigsaw;
use PODEntender\EventHandler\HandlerInterface;

class GenerateCategoriesAfterCollections implements HandlerInterface
{
    const COLLECTION_NAME_ALL = 'Todos';

    public function handle(Jigsaw $jigsaw): void
    {
        $episodes = $jigsaw->getCollection('episodes');

        $jigsaw->getSiteData()->put(self::COLLECTION_NAME_ALL, $episodes);

        $episodes->groupBy('category')->each(function (Collection $episodes, string $category) use ($jigsaw) {
            $jigsaw->getSiteData()->put($category, $episodes);
        });
    }
}

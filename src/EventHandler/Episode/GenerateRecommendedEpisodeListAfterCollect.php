<?php

namespace PODEntender\EventHandler\Episode;

use Illuminate\Support\Collection;
use PODEntender\EventHandler\HandlerInterface;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\PageVariable;

class GenerateRecommendedEpisodeListAfterCollect implements HandlerInterface
{
    const NUMBER_OF_RECOMMENDATIONS = 3;

    public function handle(Jigsaw $jigsaw): void
    {
        $jigsaw
            ->getCollection('episodes')
            ->each(function (PageVariable $page) use ($jigsaw) {
                $page->recommended = $this->getRecommendationsForPage(
                    $jigsaw->getCollection('episodes')->merge([]),
                    $page,
                    self::NUMBER_OF_RECOMMENDATIONS
                );
            });
    }

    /**
     * @param Collection $episodes
     * @param PageVariable $page
     * @param int $maximumAmount
     *
     * @return Collection
     */
    public function getRecommendationsForPage(
        Collection $episodes,
        PageVariable $page,
        int $maximumAmount
    ): Collection
    {
        $recommended = collect([
            $episodes->pop(),
            $episodes->pop(),
            $episodes->pop(),
        ]);

        return $recommended
            ->filter(function ($item) {
                return !is_null($item);
            })
            ->filter(function ($item) use ($page) {
                return !($item === $page);
            })
            ->take($maximumAmount);
    }
}

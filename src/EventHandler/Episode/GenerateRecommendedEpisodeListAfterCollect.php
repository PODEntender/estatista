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
        $tags = $page->tags ?? [];
        return $episodes
            ->filter(function (PageVariable $episode) use ($page, $tags) {
                // Never recommend current page
                if ($episode->getUrl() === $page->getUrl()) {
                    return false;
                }

                $episodeTags = $episode->tags ?? [];
                return count(array_intersect($episodeTags, $tags)) > 0;
            })
            // Order by amount of matching tags
            ->sortByDesc(function (PageVariable $episode) use ($tags) {
                return count(array_intersect($episode->tags ?? [], $tags));
            })
            // Latest episodes first
            ->sortByDesc(function (PageVariable $episode) {
                return (int) $episode->episode['number'];
            })
            ->take($maximumAmount);
    }
}

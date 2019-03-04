<?php

namespace PODEntender\EventHandler\Episode;

use FeedIo\Feed;
use PODEntender\EventHandler\HandlerInterface;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\PageVariable;

class DecorateConfigWithEpisodesInformationAfterCollect implements HandlerInterface
{
    public function handle(Jigsaw $jigsaw): void
    {
        /** @var PageVariable $episodesCollection */
        $episodes = $jigsaw->getCollection('episodes');

        $jigsaw->setConfig('lastEpisode', $this->getLastEpisode($episodes));
        $jigsaw->setConfig('latestEpisodesPerCategory', $this->getLatestEpisodes($episodes));
    }

    private function getLastEpisode(PageVariable $episodes): PageVariable
    {
        return $episodes
            ->sortByDesc(function (PageVariable $episode) {
                return $episode->episode['number'];
            })
            ->first();
    }

    private function getLatestEpisodes(PageVariable $episodes): array
    {
        $lastEpisode = $this->getLastEpisode($episodes);

        return $episodes
            ->map(function (PageVariable $episode) {
                return $episode->category;
            })
            ->values()
            ->unique()
            ->reduce(function (array $categories, string $category) use ($episodes, $lastEpisode) {
                $categories[$category] = $episodes
                    ->filter(function (PageVariable $episode) use ($category, $lastEpisode) {
                        // De-duplicates last episode from recommendations list
                        if ($episode === $lastEpisode) {
                            return false;
                        }

                        return $episode->category === $category;
                    })
                    ->sortByDesc(function (PageVariable $episode) {
                        return $episode->episode['number'];
                    })
                    ->take(3)
                    ->values();

                return $categories;
            }, []);
    }
}

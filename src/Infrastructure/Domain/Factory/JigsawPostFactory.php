<?php

namespace PODEntender\Infrastructure\Domain\Factory;

use PODEntender\Domain\Model\FileProcessing\RssFeedConfiguration;
use PODEntender\Domain\Model\Post\AudioEpisode;
use PODEntender\Domain\Model\Post\Post;
use PODEntender\Domain\Model\Post\PostImage;
use PODEntender\Domain\Model\Post\PostImageCollection;
use PODEntender\Domain\Service\Post\Recommendation;
use TightenCo\Jigsaw\PageVariable;

class JigsawPostFactory
{
    private $feedConfiguration;

    private $recommendationService;

    public function __construct(RssFeedConfiguration $feedConfiguration, Recommendation $recommendationService)
    {
        $this->feedConfiguration = $feedConfiguration;
        $this->recommendationService = $recommendationService;
    }

    public function newPostFromPageVariable(PageVariable $page): Post
    {
        $date = new \DateTime();

        $episode = $page->episode;

        return new Post(
            $page->getUrl(),
            $page->getUrl(),
            $episode['title'],
            $episode['description'],
            $episode['author'],
            $page->getContent(),
            $episode['category'],
            $this->createImageCollectionFromPageVariable($page),
            $page->tags ?? [],
            \DateTimeImmutable::createFromMutable($date->setTimestamp($page->date)),
            \DateTimeImmutable::createFromMutable($date->setTimestamp($episode['date']))
        );
    }

    public function newAudioEpisodeFromPageVariable(PageVariable $page): AudioEpisode
    {
        $date = new \DateTime();

        $episode = $page->episode;
        
        return new AudioEpisode(
            $page->getUrl(),
            $page->getUrl(),
            $episode['title'],
            $episode['description'],
            $episode['author'] ?? '',
            $page->getContent(),
            $page->get('category'),
            $this->createImageCollectionFromPageVariable($page),
            $page->tags ?? [],
            \DateTimeImmutable::createFromMutable($date->setTimestamp($page->date)),
            \DateTimeImmutable::createFromMutable($date->setTimestamp($episode['date'])),
            $this->feedConfiguration->explicit(),
            $episode['audioDuration'] ?? '00:00:00',
            $episode['audioUrl'],
            $page->getBaseUrl() . $episode['cover']['url'] ?? ''
        );
    }

    private function createImageCollectionFromPageVariable(PageVariable $page): PostImageCollection
    {
        $episode = $page->episode;

        $cover = new PostImage(
            $page->getBaseUrl() . $episode['cover']['url'],
            $episode['cover']['title'] ?? '',
            $episode['cover']['alt'] ?? '',
            true
        );

        return new PostImageCollection([$cover]);
    }
}

<?php

namespace PODEntender\Application\Service\Post;

use PODEntender\Domain\Model\Post\AudioEpisode;
use PODEntender\Domain\Model\Post\AudioEpisodeCollection;
use PODEntender\Domain\Model\Post\PostRepository;

class FetchLatestEpisodes
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function execute(int $amount, ?string $category): AudioEpisodeCollection
    {
        return $this->postRepository
            ->withAudio()
            ->filter(function (AudioEpisode $episode) use ($category) {
                return is_null($category) || $episode->category() === $category;
            })
            ->sortByDesc(function (AudioEpisode $episode) {
                return $episode->createdAt();
            })
            ->take($amount);
    }
}

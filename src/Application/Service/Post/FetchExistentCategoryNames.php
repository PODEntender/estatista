<?php

namespace PODEntender\Application\Service\Post;

use PODEntender\Domain\Model\Post\AudioEpisode;
use PODEntender\Domain\Model\Post\PostRepository;

class FetchExistentCategoryNames
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function execute(): array
    {
        return $this->postRepository
            ->withAudio()
            ->map(function (AudioEpisode $episode) {
                return $episode->category();
            })
            ->unique()
            ->values()
            ->sort()
            ->toArray();
    }
}

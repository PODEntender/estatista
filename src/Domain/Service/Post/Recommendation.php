<?php

namespace PODEntender\Domain\Service\Post;

use PODEntender\Domain\Model\Post\AudioEpisode;
use PODEntender\Domain\Model\Post\AudioEpisodeCollection;
use PODEntender\Domain\Model\Post\Post;
use PODEntender\Domain\Model\Post\PostRepository;

class Recommendation
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function recommendEpisodesForPost(Post $post, int $amount): AudioEpisodeCollection
    {
        $tags = $post->tags() ?? [];

        $recommended = collect($this->postRepository->withAudio()->getArrayCopy())
            ->filter(function (AudioEpisode $episode) use ($post) {
                return $post->url() !== $episode->url();
            })
            ->sortByDesc(function (AudioEpisode $episode) use ($tags) {
                return count(array_intersect($episode->tags() ?? [], $tags));
            })
            ->take($amount)
            ->toArray();

        return new AudioEpisodeCollection($recommended);
    }
}

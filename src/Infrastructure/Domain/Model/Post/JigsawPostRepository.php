<?php

namespace PODEntender\Infrastructure\Domain\Model\Post;

use PODEntender\Domain\Model\Post\PostRepository;


use PODEntender\Domain\Model\Post\AudioEpisodeCollection;
use PODEntender\Domain\Model\Post\Post;
use PODEntender\Domain\Model\Post\PostCollection;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\PageVariable;

class JigsawPostRepository implements PostRepository
{
    /** @var Jigsaw */
    private $jigsaw;

    public function __construct(Jigsaw $jigsaw)
    {
        $this->jigsaw = $jigsaw;
    }

    private function jigsawCollectionToPostCollection(PageVariable $collection): PostCollection
    {
        return new PostCollection(
            $collection
                ->map(function (PageVariable $post) {
                    return $post->makePostEntity();
                })
                ->toArray()
        );
    }

    private function jigsawCollectionToAudioEpisodeCollection(PageVariable $collection): AudioEpisodeCollection
    {
        return new AudioEpisodeCollection(
            $collection
                ->map(function (PageVariable $post) {
                    return $post->makeAudioEpisodeEntity();
                })
                ->toArray()
        );
    }

    public function latestPost(): Post
    {
        return $this->jigsaw->getCollection('episodes')->sortByDesc('postDate')->first()->makePostEntity();
    }

    public function latestPosts(int $amount): PostCollection
    {
        return $this->jigsawCollectionToPostCollection(
            $this->jigsaw
                ->getCollection('episodes')
                ->sortByDesc('postDate')
                ->take($amount)
        );
    }

    public function byCategory(string $category): PostCollection
    {
        return $this->jigsawCollectionToPostCollection(
            $this->jigsaw
                ->getCollection('episodes')
                ->whereStrict('category', $category)
        );
    }

    public function withAudio(): AudioEpisodeCollection
    {
        return $this->jigsawCollectionToAudioEpisodeCollection(
            $this->jigsaw
                ->getCollection('episodes')
                ->whereNotIn('episode.audioUrl', [null])
        );
    }
}

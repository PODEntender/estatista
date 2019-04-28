<?php

namespace PODEntender\Infrastructure\Domain\Model\Post;

use PODEntender\Domain\Model\Post\PostRepository;

use PODEntender\Domain\Model\Post\AudioEpisodeCollection;
use PODEntender\Domain\Model\Post\Post;
use PODEntender\Domain\Model\Post\PostCollection;
use PODEntender\Infrastructure\Domain\Factory\JigsawPostFactory;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\PageVariable;

class JigsawPostRepository implements PostRepository
{
    private $jigsaw;

    private $jigsawPostFactory;

    public function __construct(Jigsaw $jigsaw, JigsawPostFactory $jigsawPostFactory)
    {
        $this->jigsaw = $jigsaw;
        $this->jigsawPostFactory = $jigsawPostFactory;
    }

    private function jigsawCollectionToPostCollection(PageVariable $collection): PostCollection
    {
        return new PostCollection(
            $collection
                ->map(function (PageVariable $post) {
                    return $this->jigsawPostFactory->newPostFromPageVariable($post);
                })
                ->toArray()
        );
    }

    private function jigsawCollectionToAudioEpisodeCollection(PageVariable $collection): AudioEpisodeCollection
    {
        return new AudioEpisodeCollection(
            $collection
                ->map(function (PageVariable $post) {
                    return $this->jigsawPostFactory->newAudioEpisodeFromPageVariable($post);
                })
                ->toArray()
        );
    }

    public function latestPost(): Post
    {
        return $this->jigsawPostFactory->newPostFromPageVariable(
            $this->jigsaw
                ->getCollection('episodes')
                ->sortByDesc('postDate')
                ->first()
        );
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
                ->filter(function (PageVariable $page) {
                    return !is_null($page->episode['audioUrl']);
                })
        );
    }
}

<?php

namespace PODEntender\Domain\Model\Post;

interface PostRepository
{
    public function latestPost(): Post;

    public function latestPosts(int $amount): PostCollection;

    public function byCategory(string $category): PostCollection;

    public function withAudio(): AudioEpisodeCollection;
}

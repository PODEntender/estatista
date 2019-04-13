<?php

namespace PODEntender\Application\Service\Post;

use PODEntender\Domain\Model\Post\Post;
use PODEntender\Domain\Model\Post\PostCollection;
use PODEntender\Domain\Service\Post\Recommendation as RecommendationService;

class FetchRecommendationsForPost
{
    private $recommendationService;

    public function __construct(RecommendationService $recommendationService)
    {
        $this->recommendationService = $recommendationService;
    }

    public function execute(Post $post, int $limit): PostCollection
    {
        return $this->recommendationService
            ->recommendEpisodesForPost($post, $limit)
            ->take($limit);
    }
}

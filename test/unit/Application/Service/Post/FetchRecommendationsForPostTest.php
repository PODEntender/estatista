<?php

namespace PODEntender\Application\Service\Post;

use PHPUnit\Framework\TestCase;
use PODEntender\Domain\Model\Post\AudioEpisode;
use PODEntender\Domain\Model\Post\AudioEpisodeCollection;
use PODEntender\Domain\Service\Post\Recommendation;

class FetchRecommendationsForPostTest extends TestCase
{
    /** @var Recommendation */
    private $recommendationService;

    /** @var FetchRecommendationsForPost */
    private $fetchRecommendationsForPostService;

    protected function setUp(): void
    {
        $this->recommendationService = $this->prophesize(Recommendation::class);

        $this->fetchRecommendationsForPostService = new FetchRecommendationsForPost(
            $this->recommendationService->reveal()
        );
    }

    public function testExecute(): void
    {
        $referencePost = $this->prophesize(AudioEpisode::class)->reveal();
        $episode01 = $this->prophesize(AudioEpisode::class)->reveal();
        $episode02 = $this->prophesize(AudioEpisode::class)->reveal();
        $episode03 = $this->prophesize(AudioEpisode::class)->reveal();
        $episode04 = $this->prophesize(AudioEpisode::class)->reveal();

        $this->recommendationService
            ->recommendEpisodesForPost($referencePost, 2)
            ->willReturn(new AudioEpisodeCollection([$episode01, $episode02, $episode03, $episode04]));

        $result = $this->fetchRecommendationsForPostService->execute($referencePost, 2);
        $this->assertCount(2, $result);
    }
}

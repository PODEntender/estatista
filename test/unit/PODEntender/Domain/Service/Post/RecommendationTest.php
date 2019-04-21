<?php

namespace PODEntender\Domain\Service\Post;

use DateTime;
use PHPUnit\Framework\TestCase;
use PODEntender\Domain\Model\Post\AudioEpisode;
use PODEntender\Domain\Model\Post\AudioEpisodeCollection;
use PODEntender\Domain\Model\Post\PostRepository;

class RecommendationTest extends TestCase
{
    /** @var PostRepository */
    private $postRepository;

    /** @var Recommendation */
    private $recommendationService;

    protected function setUp(): void
    {
        $this->postRepository = $this->prophesize(PostRepository::class);

        $this->recommendationService = new Recommendation(
            $this->postRepository->reveal()
        );
    }

    public function testRecommendEpisodesForPostDoesntIncludeReferencePost(): void
    {
        $this->postRepository->withAudio()->willReturn($this->createDefaultAudioEpisodeCollection());

        $referenceEpisodeProphecy = $this->prophesize(AudioEpisode::class);
        $referenceEpisodeProphecy->guid()->willReturn('ep03');
        $referenceEpisodeProphecy->tags()->willReturn([]);
        $referenceEpisode = $referenceEpisodeProphecy->reveal();

        $recommended = $this->recommendationService
            ->recommendEpisodesForPost(
                $referenceEpisode,
                999
            )
            ->filter(function (AudioEpisode $episode) use ($referenceEpisode) {
                return $episode->guid() === $referenceEpisode->guid();
            });

        $this->assertEmpty($recommended);
    }

    public function testRecommendationsAreSortedByCreationDateDescending(): void
    {
        $this->postRepository->withAudio()->willReturn($this->createDefaultAudioEpisodeCollection());

        $referenceEpisodeProphecy = $this->prophesize(AudioEpisode::class);
        $referenceEpisodeProphecy->guid()->willReturn('ep03');
        $referenceEpisodeProphecy->tags()->willReturn([]);
        $referenceEpisode = $referenceEpisodeProphecy->reveal();

        $recommended = $this->recommendationService->recommendEpisodesForPost($referenceEpisode,999);

        $this->assertGreaterThan($recommended->last()->createdAt(), $recommended->first()->createdAt());
    }

    public function testRecommendationsAreLimitedByAmountParameter(): void
    {
        $this->postRepository->withAudio()->willReturn($this->createDefaultAudioEpisodeCollection());

        $referenceEpisodeProphecy = $this->prophesize(AudioEpisode::class);
        $referenceEpisodeProphecy->guid()->willReturn('ep03');
        $referenceEpisodeProphecy->tags()->willReturn([]);
        $referenceEpisode = $referenceEpisodeProphecy->reveal();

        $recommended = $this->recommendationService->recommendEpisodesForPost($referenceEpisode,2);
        $this->assertEquals(2, $recommended->count());

        $recommended = $this->recommendationService->recommendEpisodesForPost($referenceEpisode,1);
        $this->assertEquals(1, $recommended->count());
    }

    private function createDefaultAudioEpisodeCollection(): AudioEpisodeCollection
    {
        $episode01 = $this->prophesize(AudioEpisode::class);
        $episode01->guid()->willReturn('ep01');
        $episode01->tags()->willReturn([]);
        $episode01->createdAt()->willReturn(new DateTime('2019-01-01'));

        $episode02 = $this->prophesize(AudioEpisode::class);
        $episode02->guid()->willReturn('ep02');
        $episode02->tags()->willReturn([]);
        $episode02->createdAt()->willReturn(new DateTime('2019-02-01'));

        $episode03 = $this->prophesize(AudioEpisode::class);
        $episode03->guid()->willReturn('ep03');
        $episode03->tags()->willReturn([]);
        $episode03->createdAt()->willReturn(new DateTime('2019-03-01'));

        return new AudioEpisodeCollection([
            $episode01->reveal(),
            $episode02->reveal(),
            $episode03->reveal(),
        ]);
    }
}

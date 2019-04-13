<?php

namespace PODEntender\Application\Service\Post;

use PHPUnit\Framework\TestCase;
use PODEntender\Domain\Model\Post\AudioEpisode;
use PODEntender\Domain\Model\Post\AudioEpisodeCollection;
use PODEntender\Domain\Model\Post\PostRepository;

class FetchLatestEpisodesTest extends TestCase
{
    /** @var PostRepository */
    private $postRepository;

    /** @var FetchLatestEpisodes */
    private $fetchLatestEpisodesService;

    protected function setUp(): void
    {
        $this->postRepository = $this->prophesize(PostRepository::class);
        $this->fetchLatestEpisodesService = new FetchLatestEpisodes(
            $this->postRepository->reveal()
        );
    }

    public function testExecuteFetchesExactAmount(): void
    {
        $audioEpisodeCollection = $this->createDefaultAudioEpisodeCollection()
            ->sortByDesc(function (AudioEpisode $episode) {
                return $episode->createdAt();
            });

        $this->postRepository->withAudio()->willReturn($audioEpisodeCollection);

        $result = $this->fetchLatestEpisodesService->execute(2, null);
        $this->assertEquals(2, $result->count());

        $lastEpisode = $result->first();
        $episodeBeforeLast = $result->last();

        $this->assertEquals($audioEpisodeCollection->take(2)->first()->guid(), $lastEpisode->guid());
        $this->assertEquals($audioEpisodeCollection->take(2)->last()->guid(), $episodeBeforeLast->guid());
    }

    public function testExecuteFiltersCategoryName(): void
    {
        $audioEpisodeCollection = $this->createDefaultAudioEpisodeCollection()
            ->sortByDesc(function (AudioEpisode $episode) {
                return $episode->createdAt();
            });

        $this->postRepository->withAudio()->willReturn($audioEpisodeCollection);

        $result = $this->fetchLatestEpisodesService->execute(2, 'Entrevista');
        $this->assertEquals(2, $result->count());

        $lastEpisode = $result->first();
        $episodeBeforeLast = $result->last();

        $this->assertEquals($audioEpisodeCollection->take(2)->last()->guid(), $lastEpisode->guid());
        $this->assertEquals($audioEpisodeCollection->last()->guid(), $episodeBeforeLast->guid());
    }

    private function createDefaultAudioEpisodeCollection(): AudioEpisodeCollection
    {
        $episode01 = $this->prophesize(AudioEpisode::class);
        $episode01->guid()->willReturn('ep01');
        $episode01->category()->willReturn('Entrevista');
        $episode01->createdAt()->willReturn(new \DateTime('2019-01-01'));

        $episode02 = $this->prophesize(AudioEpisode::class);
        $episode02->guid()->willReturn('ep02');
        $episode02->category()->willReturn('Entrevista');
        $episode02->createdAt()->willReturn(new \DateTime('2019-02-01'));

        $episode03 = $this->prophesize(AudioEpisode::class);
        $episode03->guid()->willReturn('ep03');
        $episode03->category()->willReturn('News');
        $episode03->createdAt()->willReturn(new \DateTime('2019-03-01'));

        return new AudioEpisodeCollection([
            $episode01->reveal(),
            $episode02->reveal(),
            $episode03->reveal(),
        ]);
    }
}

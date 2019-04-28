<?php

namespace PODEntender\Application\Service\Post;

use PHPUnit\Framework\TestCase;
use PODEntender\Domain\Model\Post\AudioEpisode;
use PODEntender\Domain\Model\Post\AudioEpisodeCollection;
use PODEntender\Domain\Model\Post\PostRepository;

class FetchExistentCategoryNamesTest extends TestCase
{
    /** @var PostRepository */
    private $postRepository;

    /** @var FetchExistentCategoryNames */
    private $fetchExistentCategoryNames;

    protected function setUp(): void
    {
        $this->postRepository = $this->prophesize(PostRepository::class);
        $this->fetchExistentCategoryNames = new FetchExistentCategoryNames(
            $this->postRepository->reveal()
        );
    }

    public function testExecute(): void
    {
        $episode01 = $this->prophesize(AudioEpisode::class);
        $episode01->category()->willReturn('Entrevista');

        $episode02 = $this->prophesize(AudioEpisode::class);
        $episode02->category()->willReturn('Drops');

        $episode03 = $this->prophesize(AudioEpisode::class);
        $episode03->category()->willReturn('News');

        $episode04 = $this->prophesize(AudioEpisode::class);
        $episode04->category()->willReturn('Entrevista');

        $this->postRepository->withAudio()->willReturn(new AudioEpisodeCollection([
            $episode01->reveal(),
            $episode02->reveal(),
            $episode03->reveal(),
            $episode04->reveal(),
        ]));

        $categoryNames = $this->fetchExistentCategoryNames->execute();
        $this->assertCount(3, $categoryNames);
        $this->assertContains('Entrevista', $categoryNames);
        $this->assertContains('Drops', $categoryNames);
        $this->assertContains('News', $categoryNames);
    }
}

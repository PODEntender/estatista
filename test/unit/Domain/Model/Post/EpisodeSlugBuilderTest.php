<?php

namespace PODEntender\Domain\Model\Post;

use PHPUnit\Framework\TestCase;

class EpisodeSlugBuilderTest extends TestCase
{
    /** @var EpisodeSlugBuilder */
    private $slugBuilder;

    protected function setUp(): void
    {
        $this->slugBuilder = new EpisodeSlugBuilder();
    }

    public function testForcingEpisodeSlugIsPrefixed(): void
    {
        $slug = $this->slugBuilder->build('999', '000', 'forced/slug');

        $this->assertEquals('episodio/forced/slug', $slug);
    }

    public function testSlugDefaultFormat(): void
    {
        $slug = $this->slugBuilder->build('020', 'This is a testing title', null);

        $this->assertEquals('episodio/020-this-is-a-testing-title', $slug);
    }
}

<?php

namespace PODEntender\Infrastructure\Domain\Model\Post;

use PHPUnit\Framework\TestCase;
use PODEntender\Domain\Model\FileProcessing\RssFeedConfiguration;
use PODEntender\Infrastructure\Domain\Factory\JigsawPostFactory;
use TightenCo\Jigsaw\IterableObject;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\PageVariable;

class JigsawPostRepositoryTest extends TestCase
{
    private $jigsaw;

    /** @var JigsawPostRepository */
    private $postRepository;

    protected function setUp(): void
    {
        $this->jigsaw = $this->prophesize(Jigsaw::class);
        $rssConfiguration = $this->prophesize(RssFeedConfiguration::class);
        $rssConfiguration->explicit()->willReturn('clean');

        $this->postRepository = new JigsawPostRepository(
            $this->jigsaw->reveal(),
            new JigsawPostFactory($rssConfiguration->reveal())
        );
    }

    private function buildNewPage(
        string $postDate,
        ?string $category = 'default',
        ?bool $hasAudio = false
    ): PageVariable
    {
        return new PageVariable([
            'extends' => '_layouts/test-base',
            'postDate' => strtotime($postDate),
            'category' => $category,
            'date' => strtotime($postDate),
            'episode' => [
                'title' => '',
                'description' => '',
                'author' => '',
                'date' => strtotime($postDate),
                'audioUrl' => $hasAudio ? $postDate . '.mp3' : null,
                'cover' => [
                    'url' => '',
                ],
            ],
            '_meta' => new IterableObject([
                'baseUrl' => 'tmp://test.env',
                'category' => $category,
                'content' => 'dummy content',
                'collectionName' => 'episodes',
                'url' => '/test/' . $postDate . '.html',
                'filename' => 'test/filename/' . $postDate . '.md',
            ]),
        ]);
    }

    public function testLatestPost(): void
    {
        $this->jigsaw->getCollection('episodes')->willReturn(new PageVariable([
            $this->buildNewPage('2019-04-18'),
            $this->buildNewPage('2019-04-28'),
            $this->buildNewPage('2019-04-08'),
        ]));

        $latestPost = $this->postRepository->latestPost();

        $this->assertEquals('2019-04-28', $latestPost->createdAt()->format('Y-m-d'));
    }

    public function testLatestPosts(): void
    {
        $this->jigsaw->getCollection('episodes')->willReturn(new PageVariable([
            $this->buildNewPage('2019-04-01'),
            $this->buildNewPage('2019-04-18'),
            $this->buildNewPage('2019-04-08'),
            $this->buildNewPage('2019-04-28'),
        ]));

        $latestPosts = $this->postRepository->latestPosts(2);

        $this->assertCount(2, $latestPosts);
        $this->assertEquals('2019-04-28', $latestPosts->first()->createdAt()->format('Y-m-d'));
        $this->assertEquals('2019-04-18', $latestPosts->last()->createdAt()->format('Y-m-d'));
    }

    public function testByCategory(): void
    {
        $this->jigsaw->getCollection('episodes')->willReturn(new PageVariable([
            $this->buildNewPage('2019-04-01', 'news'),
            $this->buildNewPage('2019-04-08', 'news'),
            $this->buildNewPage('2019-04-18', 'drops'),
            $this->buildNewPage('2019-04-28', 'drops'),
        ]));

        $news = $this->postRepository->byCategory('news');

        $this->assertCount(2, $news);
        $this->assertEquals('2019-04-01', $news->first()->createdAt()->format('Y-m-d'));
        $this->assertEquals('2019-04-08', $news->last()->createdAt()->format('Y-m-d'));
    }

    public function testWithAudio(): void
    {
        $this->jigsaw->getCollection('episodes')->willReturn(new PageVariable([
            $this->buildNewPage('2019-04-01', 'default', true),
            $this->buildNewPage('2019-04-08', 'default', false),
            $this->buildNewPage('2019-04-18', 'default', false),
            $this->buildNewPage('2019-04-28', 'default', true),
        ]));

        $episodes = $this->postRepository->withAudio();

        $this->assertCount(2, $episodes);
        $this->assertEquals('2019-04-01', $episodes->first()->createdAt()->format('Y-m-d'));
        $this->assertEquals('2019-04-28', $episodes->last()->createdAt()->format('Y-m-d'));
    }
}

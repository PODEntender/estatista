<?php

namespace PODEntender\Application\Service\FileProcessing;

use PHPUnit\Framework\TestCase;
use PODEntender\Domain\Model\Feed\ChannelBuilder;
use PODEntender\Domain\Model\Feed\FeedBuilder;
use PODEntender\Domain\Model\Feed\ItemBuilder;
use PODEntender\Domain\Model\FileProcessing\RssFeedConfiguration;
use PODEntender\Domain\Model\Post\AudioEpisode;
use PODEntender\Domain\Model\Post\AudioEpisodeCollection;
use PODEntender\Domain\Model\Post\PostRepository;
use SimpleXMLElement;

class GenerateRssFeedTest extends TestCase
{
    /** @var GenerateRssFeed */
    private $generateRssFeed;

    /** @var PostRepository */
    private $postRepository;

    /** @var RssFeedConfiguration */
    private $rssConfiguration;

    public function setUp(): void
    {
        $this->postRepository = $this->prophesize(PostRepository::class);

        $this->generateRssFeed = new GenerateRssFeed(
            new FeedBuilder(),
            $this->postRepository->reveal()
        );

        $this->rssConfiguration = new RssFeedConfiguration(
            'My Test Title',
            'My Test Subtitle',
            'My Test Description',
            \DateTime::createFromFormat('Y-m-d', '2019-05-01'),
            'pt-BR',
            'My Test Generator',
            'MY Test Managing Editor',
            'My Test Image Url',
            'My Test Url',
            'My Test Feed Url',
            'My Test Author',
            'My Test Explicit',
            'My Test Type',
            'My Test Email',
            'My Test Category',
            'my/test/output.xml'
        );
    }

    public function testValidRssElementIsGenerated(): void
    {
        $this->postRepository->withAudio()->willReturn(new AudioEpisodeCollection());

        $outputFile = $this->generateRssFeed->execute($this->rssConfiguration);
        $reader = new SimpleXMLElement($outputFile->content());

        $this->assertEquals('rss', $reader->getName());
    }

    public function testDestinationPathMatchesConfiguration(): void
    {
        $this->postRepository->withAudio()->willReturn(new AudioEpisodeCollection());

        $outputFile = $this->generateRssFeed->execute($this->rssConfiguration);
        $this->assertEquals($this->rssConfiguration->outputFilepath(), $outputFile->path());
    }

    public function testRssConfigurationIsPresentOnXml(): void
    {
        $this->postRepository->withAudio()->willReturn(new AudioEpisodeCollection());

        $outputFile = $this->generateRssFeed->execute($this->rssConfiguration);
        $reader = new SimpleXMLElement($outputFile->content());

        $this->assertEquals($this->rssConfiguration->title(), $reader->channel->title);
        $this->assertEquals($this->rssConfiguration->url(), $reader->channel->link);
        $this->assertEquals($this->rssConfiguration->description(), $reader->channel->description);
        $this->assertEquals(
            $this->rssConfiguration->lastBuildDate()->format(ChannelBuilder::DATE_FORMAT),
            $reader->channel->lastBuildDate
        );
        $this->assertEquals($this->rssConfiguration->language(), $reader->channel->language);
        $this->assertEquals($this->rssConfiguration->generator(), $reader->channel->generator);
        $this->assertEquals($this->rssConfiguration->managingEditor(), $reader->channel->managingEditor);
        $this->assertEquals($this->rssConfiguration->category(), $reader->channel->category);

        $this->assertEquals($this->rssConfiguration->title(), $reader->channel->image->title);
        $this->assertEquals($this->rssConfiguration->imageUrl(), $reader->channel->image->url);
        $this->assertEquals($this->rssConfiguration->url(), $reader->channel->image->link);

        $atomLink = $reader->xpath('channel/atom:link')[0];
        $this->assertEquals($this->rssConfiguration->feedUrl(), $atomLink['href']);
        $this->assertEquals('self', $atomLink['rel']);
        $this->assertEquals('application/rss+xml', $atomLink['type']);

        $this->assertEquals($this->rssConfiguration->subtitle(), $reader->xpath('channel/itunes:subtitle')[0]);
        $this->assertEquals($this->rssConfiguration->description(), $reader->xpath('channel/itunes:summary')[0]);
        $this->assertEquals($this->rssConfiguration->author(), $reader->xpath('channel/itunes:author')[0]);
        $this->assertEquals($this->rssConfiguration->explicit(), $reader->xpath('channel/itunes:explicit')[0]);
        $this->assertEquals($this->rssConfiguration->type(), $reader->xpath('channel/itunes:type')[0]);
        $this->assertEquals(
            $this->rssConfiguration->category(),
            $reader->xpath('channel/itunes:category')[0]['text']
        );
        $this->assertEquals(
            $this->rssConfiguration->imageUrl(),
            $reader->xpath('channel/itunes:image')[0]['href']
        );
        $this->assertEquals(
            $this->rssConfiguration->author(),
            $reader->xpath('channel/itunes:owner/itunes:name')[0]
        );
        $this->assertEquals(
            $this->rssConfiguration->email(),
            $reader->xpath('channel/itunes:owner/itunes:email')[0]
        );

        $this->assertEquals(
            $this->rssConfiguration->description(),
            $reader->xpath('channel/googleplay:description')[0]
        );
    }

    public function testAudioItemsArePresentOnXml(): void
    {
        $episode = $this->prophesize(AudioEpisode::class);
        $episode->guid()->willReturn('My Test Guid');
        $episode->title()->willReturn('My Test Title');
        $episode->description()->willReturn('My Test Description');
        $episode->audioCover()->willReturn('My Test Audio Cover');
        $episode->audioUrl()->willReturn('My Test Audio Url');
        $episode->author()->willReturn('My Test Author');
        $episode->url()->willReturn('My Test Url');
        $episode->createdAt()->willReturn(\DateTime::createFromFormat('Y-m-d', '2019-01-01'));
        $episode->updatedAt()->willReturn(\DateTime::createFromFormat('Y-m-d', '2019-01-01'));
        $episode->duration()->willReturn('00:00:00');
        $episode->category()->willReturn('My Test Category');

        $actualEpisode = $episode->reveal();
        $this->postRepository->withAudio()->willReturn(new AudioEpisodeCollection([$actualEpisode]));

        $reader = new SimpleXMLElement($this->generateRssFeed->execute($this->rssConfiguration)->content());

        $this->assertEquals($actualEpisode->title(), $reader->xpath('channel/item/title')[0]);
        $this->assertEquals($actualEpisode->url(), $reader->xpath('channel/item/link')[0]);
        $this->assertEquals($actualEpisode->url(), $reader->xpath('channel/item/comments')[0]);
        $this->assertEquals(
            $actualEpisode->createdAt()->format(ItemBuilder::DATE_FORMAT),
            $reader->xpath('channel/item/pubDate')[0]
        );
        $this->assertEquals($actualEpisode->guid(), $reader->xpath('channel/item/guid')[0]);
        $this->assertEquals('false', $reader->xpath('channel/item/guid')[0]['isPermaLink']);

        $category = $reader->xpath('channel/item/category')[0];
        $this->assertEquals($actualEpisode->category(), $category);
        $this->assertStringContainsString('CDATA', $category->asXML());

        $enclosure = $reader->xpath('channel/item/enclosure')[0];
        $this->assertEquals($actualEpisode->audioUrl(), $enclosure['url']);
        $this->assertEquals('audio/mpeg', $enclosure['type']);

        $this->assertEquals($actualEpisode->description(), $reader->xpath('channel/item/itunes:subtitle')[0]);
        $this->assertEquals($actualEpisode->description(), $reader->xpath('channel/item/itunes:summary')[0]);
        $this->assertEquals($actualEpisode->author(), $reader->xpath('channel/item/itunes:author')[0]);
        $this->assertEquals(
            $this->rssConfiguration->explicit(),
            $reader->xpath('channel/item/itunes:explicit')[0]
        );
        $this->assertEquals($actualEpisode->duration(), $reader->xpath('channel/item/itunes:duration')[0]);
        $this->assertEquals($actualEpisode->audioCover(), $reader->xpath('channel/item/itunes:image')[0]['href']);
    }
}

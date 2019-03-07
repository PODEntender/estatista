<?php

namespace PODEntender\EventHandler\Episode;

use FeedIo\Factory;
use FeedIo\Feed;
use Illuminate\Support\Collection;
use PODEntender\EventHandler\HandlerInterface;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\PageVariable;
use FeedIo\Feed\Node\ElementInterface;

class GenerateRssFeedAfterBuild implements HandlerInterface
{
    const OUTPUT_FILE = 'feed.xml';

    public function handle(Jigsaw $jigsaw): void
    {
        /** @var Feed $feed */
        $feed = $this->createFeedItems($jigsaw)
            ->reduce(function (Feed $feed, Feed\Item $item) {
                return $feed->add($item);
            }, $this->createFeed($jigsaw));

        /** @var \DOMDocument $xmlFeed */
        $xmlFeed = Factory::create()
            ->getFeedIo()
            ->getStandard('rss')
            ->getFormatter()
            ->toDom($feed);

        $xmlFeed->firstChild->setAttribute('xmlns:itunes', 'http://www.itunes.com/dtds/podcast-1.0.dtd');
        $xmlFeed->firstChild->setAttribute('xmlns:atom', 'http://www.w3.org/2005/Atom');

        $feedXmlContent = $xmlFeed->saveXML();
        $file = implode(DIRECTORY_SEPARATOR, [$jigsaw->getDestinationPath(), self::OUTPUT_FILE]);
        file_put_contents($file, $feedXmlContent);
    }

    private function createFeed(Jigsaw $jigsaw): Feed\NodeInterface
    {
        $feed = (new Feed())
            ->addElement($this->createElement('atom:link', null, [
                'href' => implode('/', [$jigsaw->getConfig('baseUrl'), self::OUTPUT_FILE]),
                'rel' => 'self',
                'type' => 'application/rss+xml',
            ]))
            ->setTitle($jigsaw->getConfig('meta.title'))
            ->setLink($jigsaw->getConfig('baseUrl'))
            ->setLastModified(date_create())
            ->set('lastBuildDate', date(DATE_RSS))
            ->set('language', 'pt-BR');

        foreach ($this->createItunesFeed($jigsaw) as $item) {
            $feed->addElement($item);
        }

        return $feed;
    }

    private function createItunesFeed(Jigsaw $jigsaw): array
    {
        return [
            $this->createElement('itunes:summary', $jigsaw->getConfig('meta.description')),
            $this->createElement('itunes:author', $jigsaw->getConfig('meta.creatorName')),
            $this->createElement('itunes:explicit', 'clean'),
            $this->createElement('itunes:image', $jigsaw->getConfig('meta.image')),
            $this->createElement('itunes:type', 'episodic'),
            $this->createElement('itunes:subtitle', $jigsaw->getConfig('meta.subtitle')),
            $this->createElement('itunes:category', $jigsaw->getConfig('meta.category')),
            $this->createElement('itunes:owner')
                ->addElement(
                    $this->createElement('itunes:name', $jigsaw->getConfig('meta.title'))
                )
                ->addElement(
                    $this->createElement('itunes:name', $jigsaw->getConfig('meta.email'))
                )
        ];
    }

    private function createElement(string $name, $value = null, array $attributes = []): ElementInterface
    {
        $element = new Feed\Node\Element();
        $element->setName($name)
            ->setValue($value);

        foreach ($attributes as $name => $attribute) {
            $element->setAttribute($name, $attribute);
        }

        return $element;
    }

    private function createFeedItems(Jigsaw $jigsaw): Collection
    {
        return $jigsaw
            ->getCollection('episodes')
            ->filter(function (PageVariable $episode) {
                return false === is_null($episode->episode['blubrry']);
            })
            ->sortByDesc(function (PageVariable $episode) {
                return $episode->episode['number'];
            })
            ->map(function (PageVariable $episode) use ($jigsaw) {
                $title = sprintf(
                    'PODEntender #%s - %s',
                    $episode->episode['number'],
                    $episode->episode['title']
                );

                $media = new Feed\Item\Media();
                $media->setType('audio/mpeg')
                    ->setUrl($episode->episode['blubrry']);

                $item = (new Feed\Item())
                    ->addMedia($media)
                    ->setTitle($title)
                    ->setDescription($episode->episode['description'])
                    ->setLink($episode->episode['link'])
                    ->setLastModified(\DateTime::createFromFormat('U', $episode->episode['date']));

                foreach ($this->createItunesFeedItem($episode, $jigsaw) as $feedElement) {
                    $item->addElement($feedElement);
                }

                return $item;
            });
    }

    private function createItunesFeedItem(PageVariable $episode, Jigsaw $jigsaw): array
    {
        return [
            $this->createElement('itunes:subtitle', $episode->episode['description']),
            $this->createElement('itunes:summary', $episode->episode['description']),
            $this->createElement('itunes:author', $jigsaw->getConfig('meta.title')),
            $this->createElement('itunes:explicit', 'clean'),
            $this->createElement('itunes:duration', $episode->episode['duration']),
        ];
    }
}

<?php

namespace PODEntender\Domain\Model\Feed;

class FeedBuilder
{
    /** @var ChannelBuilder[] */
    private $channels = [];

    public function channel(): ChannelBuilder
    {
        $channelBuilder = new ChannelBuilder($this);
        $this->channels[] = $channelBuilder;
        return $channelBuilder;
    }

    public function toXml(): string
    {
        $dom = new \DOMDocument('1.0', 'utf-8');
        $rss = $dom->appendChild($dom->createElement('rss'));
        $rss->setAttribute('xmlns:googleplay', 'http://www.google.com/schemas/play-podcasts/1.0');
        $rss->setAttribute('xmlns:itunes', 'http://www.itunes.com/dtds/podcast-1.0.dtd');
        $rss->setAttribute('xmlns:atom', 'http://www.w3.org/2005/Atom');
        $rss->setAttribute('version', '2.0');

        foreach ($this->channels as $channel) {
            $rss->appendChild($channel->toDOMElement($dom));
        }

        $dom->formatOutput = true;

        return $dom->saveXML();
    }
}

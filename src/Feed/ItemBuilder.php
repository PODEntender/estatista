<?php

namespace PODEntender\Feed;

class ItemBuilder
{
    const DATE_FORMAT = 'D, d M Y H:i:s O';

    /** @var ChannelBuilder */
    private $channelBuilder;

    /** @var string */
    private $title;

    /** @var string */
    private $link;

    /** @var string */
    private $cover;

    /** @var string */
    private $author;

    /** @var string */
    private $summary;

    /** @var string */
    private $duration;

    /** @var string */
    private $guid;

    /** @var string */
    private $pubDate;

    /** @var EnclosureBuilder[] */
    private $enclosures = [];

    public function __construct(ChannelBuilder $channelBuilder)
    {
        $this->channelBuilder = $channelBuilder;
    }

    public function title(string $title): ItemBuilder
    {
        $this->title = $title;
        return $this;
    }

    public function link(string $link): ItemBuilder
    {
        $this->link = $link;
        return $this;
    }

    public function cover(string $cover): ItemBuilder
    {
        $this->cover = $cover;
        return $this;
    }

    public function author(string $author): ItemBuilder
    {
        $this->author = $author;
        return $this;
    }

    public function summary(string $summary): ItemBuilder
    {
        $this->summary = $summary;
        return $this;
    }

    public function duration(string $duration): ItemBuilder
    {
        $this->duration = $duration;
        return $this;
    }

    public function guid(string $guid): ItemBuilder
    {
        $this->guid = $guid;
        return $this;
    }

    public function pubDate(int $time): ItemBuilder
    {
        $this->pubDate = date(self::DATE_FORMAT, $time);
        return $this;
    }

    public function addEnclosure(): EnclosureBuilder
    {
        $enclosureBuilder = new EnclosureBuilder($this);
        $this->enclosures[] = $enclosureBuilder;

        return $enclosureBuilder;
    }

    public function toDOMElement(\DOMDocument $dom): \DOMElement
    {
        $element = $dom->createElement('item');
        $element->appendChild($dom->createElement('title', $this->title));
        $element->appendChild($dom->createElement('link', $this->link));
        $element->appendChild($dom->createElement('itunes:author', $this->author));
        $element->appendChild($dom->createElement('itunes:summary', $this->summary));
        $element->appendChild($dom->createElement('itunes:duration', $this->duration));
        $element->appendChild($dom->createElement('guid', $this->guid));
        $element->appendChild($dom->createElement('pubDate', $this->pubDate));

        $element->appendChild($dom->createElement('googleplay:author', $this->author));
        $element->appendChild($dom->createElement('googleplay:image', $this->image));

        foreach ($this->enclosures as $enclosure) {
            $element->appendChild($enclosure->toDOMElement($dom));
        }

        return $element;
    }
}

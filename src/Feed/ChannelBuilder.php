<?php

namespace PODEntender\Feed;

class ChannelBuilder
{
    /** @var FeedBuilder */
    private $feedBuilder;

    /** @var string */
    private $title;

    /** @var string */
    private $link;

    /** @var string */
    private $image;

    /** @var string */
    private $category;

    /** @var string */
    private $type;

    /** @var string */
    private $generator;

    /** @var string */
    private $language;

    /** @var array FeedItem[] */
    private $items = [];

    public function __construct(FeedBuilder $feedBuilder)
    {
        $this->feedBuilder = $feedBuilder;
    }

    public function title(string $title): ChannelBuilder
    {
        $this->title = $title;
        return $this;
    }

    public function link(string $link): ChannelBuilder
    {
        $this->link = $link;
        return $this;
    }

    public function generator(string $generator): ChannelBuilder
    {
        $this->generator = $generator;
        return $this;
    }

    public function language(string $language): ChannelBuilder
    {
        $this->language = $language;
        return $this;
    }

    public function image(string $image): ChannelBuilder
    {
        $this->image = $image;
        return $this;
    }

    public function category(string $category): ChannelBuilder
    {
        $this->category = $category;
        return $this;
    }

    public function type(string $type): ChannelBuilder
    {
        $this->type = $type;
        return $this;
    }

    public function addItem(): ItemBuilder
    {
        $itemBuilder = new ItemBuilder($this);
        $this->items[] = $itemBuilder;

        return $itemBuilder;
    }

    public function close(): FeedBuilder
    {
        return $this->feedBuilder;
    }

    public function toDOMElement(\DOMDocument $dom): \DOMElement
    {
        $element = $dom->createElement('channel');
        $element->appendChild($dom->createElement('title', $this->title));
        $element->appendChild($dom->createElement('link', $this->link));
        $element->appendChild($dom->createElement('language', $this->language));
        $element->appendChild($dom->createElement('generator', $this->generator));
        $element->appendChild($dom->createElement('category', $this->category));
        $element->appendChild($dom->createElement('type', $this->type));

        $image = $dom->createElement('itunes:image');
        $image->setAttribute('href', $this->image);
        $element->appendChild($image);

        foreach ($this->items as $item) {
            $element->appendChild($item->toDOMElement($dom));
        }

        return $element;
    }
}

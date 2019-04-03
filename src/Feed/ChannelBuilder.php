<?php

namespace PODEntender\Feed;

class ChannelBuilder
{
    const DATE_FORMAT = 'D, d M Y H:i:s O';

    /** @var FeedBuilder */
    private $feedBuilder;

    /** @var string */
    private $title;

    /** @var string */
    private $subtitle;

    /** @var string */
    private $description;

    /** @var string */
    private $lastBuildDate;

    /** @var string */
    private $language;

    /** @var string */
    private $generator;

    /** @var string */
    private $managingEditor;

    /** @var string */
    private $imageUrl;

    /** @var string */
    private $url;

    /** @var string */
    private $feedUrl;

    /** @var string */
    private $author;

    /** @var string */
    private $explicit;

    /** @var string */
    private $type;

    /** @var string */
    private $email;

    /** @var string */
    private $category;

    /** @var ItemBuilder[] */
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

    public function subtitle(string $subtitle): ChannelBuilder
    {
        $this->subtitle = $subtitle;
        return $this;
    }

    public function description(string $description): ChannelBuilder
    {
        $this->description = $description;
        return $this;
    }

    public function lastBuildDate(string $lastBuildDate): ChannelBuilder
    {
        $this->lastBuildDate = $lastBuildDate;
        return $this;
    }

    public function language(string $language): ChannelBuilder
    {
        $this->language = $language;
        return $this;
    }

    public function generator(string $generator): ChannelBuilder
    {
        $this->generator = $generator;
        return $this;
    }

    public function managingEditor(string $managingEditor): ChannelBuilder
    {
        $this->managingEditor = $managingEditor;
        return $this;
    }

    public function imageUrl(string $imageUrl): ChannelBuilder
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    public function url(string $url): ChannelBuilder
    {
        $this->url = $url;
        return $this;
    }

    public function feedUrl(string $feedUrl): ChannelBuilder
    {
        $this->feedUrl = $feedUrl;
        return $this;
    }

    public function author(string $author): ChannelBuilder
    {
        $this->author = $author;
        return $this;
    }

    public function explicit(string $explicit): ChannelBuilder
    {
        $this->explicit = $explicit;
        return $this;
    }

    public function type(string $type): ChannelBuilder
    {
        $this->type = $type;
        return $this;
    }

    public function email(string $email): ChannelBuilder
    {
        $this->email = $email;
        return $this;
    }

    public function category(string $category): ChannelBuilder
    {
        $this->category = $category;
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
        $element->appendChild($dom->createElement('link', $this->url));
        $element->appendChild($dom->createElement('description', $this->description));
        $element->appendChild($dom->createElement('lastBuildDate', $this->lastBuildDate));
        $element->appendChild($dom->createElement('language', $this->language));
        $element->appendChild($dom->createElement('generator', $this->generator));
        $element->appendChild($dom->createElement('managingEditor', $this->managingEditor));
        $element->appendChild($dom->createElement('category', htmlentities($this->category)));

        $image = $dom->createElement('image');
        $image->appendChild($dom->createElement('title', $this->title));
        $image->appendChild($dom->createElement('url', $this->imageUrl));
        $image->appendChild($dom->createElement('link', $this->url));
        $element->appendChild($image);

        $atomLink = $dom->createElement('atom:link');
        $atomLink->setAttribute('href', $this->feedUrl);
        $atomLink->setAttribute('rel', 'self');
        $atomLink->setAttribute('type', 'application/rss+xml');
        $element->appendChild($atomLink);

        $element->appendChild($dom->createElement('itunes:subtitle', $this->subtitle));
        $element->appendChild($dom->createElement('itunes:summary', $this->description));
        $element->appendChild($dom->createElement('itunes:author', $this->author));
        $element->appendChild($dom->createElement('itunes:explicit', $this->explicit));
        $element->appendChild($dom->createElement('itunes:type', $this->type));

        $category = $dom->createElement('itunes:category');
        $category->setAttribute('text', $this->category);
        $element->appendChild($category);

        $itunesImage = $dom->createElement('itunes:image');
        $itunesImage->setAttribute('href', $this->imageUrl);
        $element->appendChild($itunesImage);


        $itunesOwner = $dom->createElement('itunes:owner');
        $itunesOwner->appendChild($dom->createElement('itunes:name', $this->author));
        $itunesOwner->appendChild($dom->createElement('itunes:email', $this->email));
        $element->appendChild($itunesOwner);


        $element->appendChild($dom->createElement('googleplay:description', $this->description));

        foreach ($this->items as $item) {
            $element->appendChild($item->toDOMElement($dom));
        }

        return $element;
    }
}

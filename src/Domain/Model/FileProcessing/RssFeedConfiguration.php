<?php

namespace PODEntender\Domain\Model\FileProcessing;

use DateTimeInterface;

class RssFeedConfiguration
{
    /** @var string */
    private $title;

    /** @var string */
    private $subtitle;

    /** @var string */
    private $description;

    /** @var DateTimeInterface */
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

    /** @var string */
    private $outputFilepath;

    public function __construct(
        string $title,
        string $subtitle,
        string $description,
        DateTimeInterface $lastBuildDate,
        string $language,
        string $generator,
        string $managingEditor,
        string $imageUrl,
        string $url,
        string $feedUrl,
        string $author,
        string $explicit,
        string $type,
        string $email,
        string $category,
        string $outputFilepath
    ) {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->description = $description;
        $this->lastBuildDate = $lastBuildDate;
        $this->language = $language;
        $this->generator = $generator;
        $this->managingEditor = $managingEditor;
        $this->imageUrl = $imageUrl;
        $this->url = $url;
        $this->feedUrl = $feedUrl;
        $this->author = $author;
        $this->explicit = $explicit;
        $this->type = $type;
        $this->email = $email;
        $this->category = $category;
        $this->outputFilepath = $outputFilepath;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function subtitle(): string
    {
        return $this->subtitle;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function lastBuildDate(): DateTimeInterface
    {
        return $this->lastBuildDate;
    }

    public function language(): string
    {
        return $this->language;
    }

    public function generator(): string
    {
        return $this->generator;
    }

    public function managingEditor(): string
    {
        return $this->managingEditor;
    }

    public function imageUrl(): string
    {
        return $this->imageUrl;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function feedUrl(): string
    {
        return $this->feedUrl;
    }

    public function author(): string
    {
        return $this->author;
    }

    public function explicit(): string
    {
        return $this->explicit;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function category(): string
    {
        return $this->category;
    }

    public function outputFilepath(): string
    {
        return $this->outputFilepath;
    }
}

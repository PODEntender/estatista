<?php

namespace PODEntender\Domain\Model\Post;

use DateTimeInterface;

class Post
{
    private $guid;

    private $url;

    private $title;

    private $description;

    private $author;

    private $content;

    private $category;

    private $images;

    private $tags;

    private $createdAt;

    private $updatedAt;

    private $recommended;

    public function __construct(
        string $guid,
        string $url,
        string $title,
        string $description,
        string $author,
        string $content,
        string $category,
        PostImageCollection $images,
        array $tags,
        DateTimeInterface $createdAt,
        DateTimeInterface $updatedAt
    ) {
        $this->guid = $guid;
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->author = $author;
        $this->content = $content;
        $this->category = $category;
        $this->images = $images;
        $this->tags = $tags;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;

        $this->recommended = new PostCollection();
    }

    public function guid(): string
    {
        return $this->guid;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function author(): string
    {
        return $this->author;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function category(): string
    {
        return $this->category;
    }

    public function images(): PostImageCollection
    {
        return $this->images;
    }

    public function cover(): string
    {
        return $this->images->offsetGet(0)->url();
    }

    // @todo -> create a proper TagCollection and Tag entity
    public function tags(): array
    {
        return $this->tags;
    }

    public function createdAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function recommended(): PostCollection
    {
        return $this->recommended;
    }

    public function addRecommendations(PostCollection $recommendations): self
    {
        $newSelf = clone $this;
        $newSelf->recommended = $recommendations;

        return $newSelf;
    }
}

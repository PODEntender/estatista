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

    private $createdAt;

    private $updatedAt;

    public function __construct(
        string $guid,
        string $url,
        string $title,
        string $description,
        string $author,
        string $content,
        string $category,
        PostImageCollection $images,
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
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
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

    public function createdAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }
}

<?php

namespace PODEntender\Domain\Model\Post;

class PostImage
{
    private $url;

    private $title;

    private $altText;

    private $cover;

    public function __construct(string $url, string $title, string $altText, bool $cover)
    {
        $this->url = $url;
        $this->title = $title;
        $this->altText = $altText;
        $this->cover = $cover;
    }
    public function url(): string
    {
        return $this->url;
    }
    public function title(): string
    {
        return $this->title;
    }
    public function altText(): string
    {
        return $this->altText;
    }
    public function cover(): bool
    {
        return $this->cover;
    }
}

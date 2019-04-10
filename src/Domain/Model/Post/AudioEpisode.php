<?php

namespace PODEntender\Domain\Model\Post;

use DateTimeInterface;

class AudioEpisode extends Post
{
    private $explicit;

    private $duration;

    private $audioUrl;

    private $audioCover;

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
        DateTimeInterface $updatedAt,
        string $explicit,
        string $duration,
        string $audioUrl,
        string $audioCover
    ) {
        parent::__construct(
            $guid,
            $url,
            $title,
            $description,
            $author,
            $content,
            $category,
            $images,
            $tags,
            $createdAt,
            $updatedAt
        );

        $this->explicit = $explicit;
        $this->duration = $duration;
        $this->audioUrl = $audioUrl;
        $this->audioCover = $audioCover;
    }

    public function explicit(): string
    {
        return $this->explicit;
    }

    public function duration(): string
    {
        return $this->duration;
    }

    public function audioUrl(): string
    {
        return $this->audioUrl;
    }

    public function audioCover(): string
    {
        return $this->audioCover;
    }
}

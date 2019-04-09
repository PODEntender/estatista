<?php

namespace PODEntender\Domain\Model\FileProcessing;

class OutputFile
{
    private $path;

    private $content;

    public function __construct(string $path, string $content)
    {
        $this->path = $path;
        $this->content = $content;
    }

    public function path(): string
    {
        return $this->path;
    }

    public function content(): string
    {
        return $this->content;
    }
}

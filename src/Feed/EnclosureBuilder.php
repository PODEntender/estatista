<?php

namespace PODEntender\Feed;

class EnclosureBuilder
{
    /** @var ItemBuilder */
    private $itemBuilder;

    /** @var string */
    private $url;

    /** @var int */
    private $length;

    /** @var string */
    private $type;

    public function __construct(ItemBuilder $itemBuilder)
    {
        $this->itemBuilder = $itemBuilder;
    }

    public function url(string $url): EnclosureBuilder
    {
        $this->url = $url;
        return $this;
    }

    public function length(int $length): EnclosureBuilder
    {
        $this->length = $length;
        return $this;
    }

    public function type($ype)
    {
        $this->type = $ype;
        return $this;
    }

    public function toDOMElement(\DOMDocument $dom): \DOMElement
    {
        $element = $dom->createElement('enclosure');
        $element->setAttribute('url', $this->url);
        $element->setAttribute('length', $this->length);
        $element->setAttribute('type', $this->type);

        return $element;
    }
}

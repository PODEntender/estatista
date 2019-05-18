<?php

namespace PODEntender\Domain\Model\FileProcessing\RobotsTxt;

class RobotsTxt
{
    private $sitemap;
    private $rulesSetCollection;

    public function __construct(string $sitemap, RulesSetCollection $rulesSetCollection)
    {
        $this->sitemap = $sitemap;
        $this->rulesSetCollection = $rulesSetCollection;
    }

    public function sitemap() : string
    {
        return $this->sitemap;
    }

    public function ruleSetCollection() : RulesSetCollection
    {
        return $this->rulesSetCollection;
    }
}

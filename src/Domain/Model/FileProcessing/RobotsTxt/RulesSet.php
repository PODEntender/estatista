<?php

namespace PODEntender\Domain\Model\FileProcessing\RobotsTxt;

class RulesSet
{
    private $userAgent;
    private $disallowRules = [];
    private $allowRules = [];

    public function __construct(string $userAgent)
    {
        $this->userAgent = $userAgent;
    }

    public function addDisallowRules(array $rules) : self
    {
        $this->disallowRules = array_merge($this->disallowRules, $rules);

        return $this;
    }

    public function addAllowRules(array $rules) : self
    {
        $this->allowRules = array_merge($this->allowRules, $rules);

        return $this;
    }

    public function userAgent() : string
    {
        return $this->userAgent;
    }

    public function disallowRules() : array
    {
        return $this->disallowRules;
    }

    public function allowRules() : array
    {
        return $this->allowRules;
    }
}
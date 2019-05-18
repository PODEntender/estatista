<?php

namespace PODEntender\Domain\Model\Participant;

class Participant
{
    private $name;

    private $picture;

    private $description;

    public function __construct(string $name, string $picture, string $description)
    {
        $this->name = $name;
        $this->picture = $picture;
        $this->description = $description;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function picture(): string
    {
        return $this->picture;
    }

    public function description(): string
    {
        return $this->description;
    }
}

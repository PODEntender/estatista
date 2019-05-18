<?php

namespace PODEntender\Application\Service\FileProcessing;

use PODEntender\Domain\Model\FileProcessing\OutputFile;
use PODEntender\Domain\Model\FileProcessing\RobotsTxt\RobotsTxtStringBuilder;
use PODEntender\Domain\Model\FileProcessing\RobotsTxt\RobotsTxt;

class GenerateRobotsTxtFile
{
    private $builder;

    public function __construct(RobotsTxtStringBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function execute(RobotsTxt $robotsTxt, string $path) : OutputFile
    {
        return new OutputFile($path, $this->builder->build($robotsTxt));
    }
}
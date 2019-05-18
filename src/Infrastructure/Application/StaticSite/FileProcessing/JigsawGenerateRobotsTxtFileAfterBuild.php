<?php

namespace PODEntender\Infrastructure\Application\StaticSite\FileProcessing;

use PODEntender\Infrastructure\Application\StaticSite\JigsawEventHandler;
use TightenCo\Jigsaw\Jigsaw;
use PODEntender\Infrastructure\Domain\Factory\JigsawRobotsTxtFactory;
use PODEntender\Application\Service\FileProcessing\GenerateRobotsTxtFile;

class JigsawGenerateRobotsTxtFileAfterBuild implements JigsawEventHandler
{
    public function handle(Jigsaw $jigsaw): void
    {
        $robots = $jigsaw->app->make(JigsawRobotsTxtFactory::class);
        $fileGenerator = $jigsaw->app->make(GenerateRobotsTxtFile::class);
        $outputFile = $fileGenerator->execute(
            $robots->newRobotsTxtFromConfiguration($jigsaw->getConfig('robots.RobotsTxt')),
            $jigsaw->getDestinationPath() . '/robots.txt'
        );

        file_put_contents($outputFile->path(), $outputFile->content());
    }
}

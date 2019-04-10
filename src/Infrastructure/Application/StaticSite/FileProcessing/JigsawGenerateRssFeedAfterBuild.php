<?php

namespace PODEntender\Infrastructure\Application\StaticSite\FileProcessing;

use PODEntender\Application\Service\FileProcessing\GenerateRssFeed;
use PODEntender\Domain\Model\FileProcessing\RssFeedConfiguration;
use PODEntender\Infrastructure\Application\StaticSite\JigsawEventHandler;
use TightenCo\Jigsaw\Jigsaw;

class JigsawGenerateRssFeedAfterBuild implements JigsawEventHandler
{
    public function handle(Jigsaw $jigsaw): void
    {
        /** @var RssFeedConfiguration $configuration */
        $configuration = $jigsaw->app->get(RssFeedConfiguration::class);

        /** @var GenerateRssFeed $handler */
        $handler = $jigsaw->app->make(GenerateRssFeed::class);

        $handler->execute($configuration);
    }
}

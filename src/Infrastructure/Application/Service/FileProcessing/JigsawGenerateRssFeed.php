<?php

namespace PODEntender\Infrastructure\Application\Service\FileProcessing;

use PODEntender\Application\Service\FileProcessing\GenerateRssFeed;
use PODEntender\Domain\Model\FileProcessing\RssFeedConfiguration;
use TightenCo\Jigsaw\Jigsaw;

class JigsawGenerateRssFeed
{
    public function handle(Jigsaw $jigsaw): void
    {
        /** @var RssFeedConfiguration $configuration */
        $configuration = $jigsaw->app->get(RssFeedConfiguration::class);

        /** @var GenerateRssFeed $handler */
        $handler = $jigsaw->app->make(GenerateRssFeed::class);

        $handler->handle($configuration);
    }
}

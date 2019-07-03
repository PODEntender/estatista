<?php

namespace PODEntender\Infrastructure\Application\StaticSite\FileProcessing;

use PODEntender\Infrastructure\Application\StaticSite\JigsawEventHandler;
use PODEntender\SitemapGenerator\Adapter\Jigsaw\JigsawAdapter as SitemapGenerator;
use TightenCo\Jigsaw\Jigsaw;

class JigsawGenerateSitemapAfterBuild implements JigsawEventHandler
{
    public function handle(Jigsaw $jigsaw): void
    {
        $destinationPath = implode([
            $jigsaw->getDestinationPath(),
            'sitemap.xml'
        ], DIRECTORY_SEPARATOR);
        $jigsawAdapter = $jigsaw->app->make(SitemapGenerator::class);

        $xmlDocument = $jigsawAdapter->fromCollection($jigsaw->getCollection('episodes'));

        file_put_contents($destinationPath, $xmlDocument->saveXml());
    }
}

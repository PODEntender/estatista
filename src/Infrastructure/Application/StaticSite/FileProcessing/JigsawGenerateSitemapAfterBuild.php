<?php

namespace PODEntender\Infrastructure\Application\StaticSite\FileProcessing;

use PODEntender\Infrastructure\Application\StaticSite\JigsawEventHandler;
use PODEntender\SitemapGenerator\Adapter\Jigsaw\JigsawAdapter;
use TightenCo\Jigsaw\Jigsaw;

class JigsawGenerateSitemapAfterBuild implements JigsawEventHandler
{
    public function handle(Jigsaw $jigsaw): void
    {
        $destinationPath = implode([
            $jigsaw->getDestinationPath(),
            'sitemap-episodios.xml'
        ], DIRECTORY_SEPARATOR);
        $jigsawAdapter = $jigsaw->app->make(JigsawAdapter::class);

        $xmlDocument = $jigsawAdapter->fromCollection($jigsaw->getCollection('episodes'));

        file_put_contents($destinationPath, $xmlDocument->saveXml());
    }
}

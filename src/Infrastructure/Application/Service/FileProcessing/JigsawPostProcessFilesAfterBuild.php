<?php

namespace PODEntender\Infrastructure\Application\Service\FileProcessing;

use PODEntender\Application\Service\FileProcessing\PostProcessFiles;
use PODEntender\Infrastructure\Application\Service\JigsawEventHandler;
use TightenCo\Jigsaw\Jigsaw;

class JigsawPostProcessFilesAfterBuild implements JigsawEventHandler
{
    public function handle(Jigsaw $jigsaw): void
    {
        /** @var PostProcessFiles $handler */
        $handler = $jigsaw->app->make(PostProcessFiles::class);

        $outputFiles = $handler->handle();

        foreach ($outputFiles as $outputFile) {
            file_put_contents($outputFile->path(), $outputFile->content());
        }
    }
}

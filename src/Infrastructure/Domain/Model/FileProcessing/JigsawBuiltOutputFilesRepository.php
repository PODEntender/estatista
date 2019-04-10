<?php

namespace PODEntender\Infrastructure\Domain\Model\FileProcessing;

use PODEntender\Domain\Model\FileProcessing\OutputFile;
use PODEntender\Domain\Model\FileProcessing\OutputFileCollection;
use PODEntender\Domain\Model\FileProcessing\OutputFileRepository;
use TightenCo\Jigsaw\Jigsaw;

class JigsawBuiltOutputFilesRepository implements OutputFileRepository
{
    private $jigsaw;

    public function __construct(Jigsaw $jigsaw)
    {
        $this->jigsaw = $jigsaw;
    }

    public function all(): OutputFileCollection
    {
        return new OutputFileCollection(
            collect($this->jigsaw->getOutputPaths())
                ->map(function (string $path) {
                    return $this->jigsaw->getDestinationPath() . $path . '/index.html';
                })
                ->filter(function (string $path) {
                    return file_exists($path);
                })
                ->map(function (string $path) {
                    return new OutputFile($path, file_get_contents($path));
                })
                ->toArray()
        );
    }
}

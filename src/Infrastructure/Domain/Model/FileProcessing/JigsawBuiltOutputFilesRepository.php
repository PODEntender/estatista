<?php

namespace PODEntender\Infrastructure\Domain\Model\FileProcessing;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use PODEntender\Domain\Model\FileProcessing\OutputFile;
use PODEntender\Domain\Model\FileProcessing\OutputFileCollection;
use PODEntender\Domain\Model\FileProcessing\OutputFileRepository;
use TightenCo\Jigsaw\Jigsaw;

class JigsawBuiltOutputFilesRepository implements OutputFileRepository
{
    private $jigsaw;

    private $filesystem;

    public function __construct(Jigsaw $jigsaw, Filesystem $filesystem)
    {
        $this->jigsaw = $jigsaw;
        $this->filesystem = $filesystem;
    }

    public function all(): OutputFileCollection
    {
        /** @var Collection|array $paths */
        $paths = $this->jigsaw->getOutputPaths();

        $paths = array_map(function (string $path) {
            return $this->jigsaw->getDestinationPath() . $path . '/index.html';
        }, is_array($paths) ? $paths : $paths->toArray());

        $paths = array_filter($paths, function (string $path) {
            return $this->filesystem->exists($path);
        });

        return new OutputFileCollection(array_map(function (string $path) {
            return new OutputFile($path, $this->filesystem->get($path));
        }, $paths));
    }
}

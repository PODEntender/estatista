<?php

namespace PODEntender\Infrastructure\Domain\Model\FileProcessing;

use Illuminate\Filesystem\Filesystem;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use TightenCo\Jigsaw\Jigsaw;

class JigsawBuiltOutputFilesRepositoryTest extends TestCase
{
    private $jigsaw;

    private $filesystem;

    private $outputFilesRepository;

    protected function setUp(): void
    {
        $this->jigsaw = $this->prophesize(Jigsaw::class);
        $this->filesystem = $this->prophesize(Filesystem::class);

        $this->outputFilesRepository = new JigsawBuiltOutputFilesRepository(
            $this->jigsaw->reveal(),
            $this->filesystem->reveal()
        );

        $this->jigsaw->getDestinationPath()->willReturn('/test');
    }

    public function testAllMapsPathsWithDestinationPathAndIndexFile(): void
    {
        $this->jigsaw->getOutputPaths()->willReturn(['/first-path', '/second-path']);
        $this->filesystem->exists(Argument::any())->willReturn(true);
        $this->filesystem->get(Argument::any())->willReturn('dummy content');

        $outputFiles = $this->outputFilesRepository->all();
        $firstFile = $outputFiles->first();
        $lastFile = $outputFiles->last();

        $this->assertEquals('/test/first-path/index.html', $firstFile->path());
        $this->assertEquals('/test/second-path/index.html', $lastFile->path());
    }

    public function testAllFiltersNonExistentFiles(): void
    {
        $this->jigsaw->getOutputPaths()->willReturn(['/first-path', '/second-path']);
        $this->filesystem->exists('/test/first-path/index.html')->willReturn(false);
        $this->filesystem->exists('/test/second-path/index.html')->willReturn(true);
        $this->filesystem->get(Argument::any())->willReturn('dummy content');

        $outputFiles = $this->outputFilesRepository->all();
        $firstFile = $outputFiles->first();

        $this->assertCount(1, $outputFiles);
        $this->assertEquals('/test/second-path/index.html', $firstFile->path());
        $this->assertEquals('dummy content', $firstFile->content());
    }
}

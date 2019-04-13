<?php

namespace PODEntender\Application\Service\FileProcessing;

use PHPUnit\Framework\TestCase;
use PODEntender\Domain\Model\FileProcessing\OutputFile;
use PODEntender\Domain\Model\FileProcessing\OutputFileCollection;
use PODEntender\Domain\Model\FileProcessing\OutputFileRepository;
use Symfony\Component\DomCrawler\Crawler;

class PostProcessFilesTest extends TestCase
{
    const TEST_INPUT_FILE_NAME = 'test.html';

    /** @var OutputFileRepository */
    private $outputFileRepository;

    /** @var PostProcessFiles */
    private $postProcessFilesService;

    public function setUp(): void
    {
        $this->outputFileRepository = $this->prophesize(OutputFileRepository::class);
        $this->outputFileRepository->all()->willReturn($this->fetchTestableInputFilesCollection());

        $this->postProcessFilesService = new PostProcessFiles(
            $this->outputFileRepository->reveal()
        );
    }

    public function testExecuteWillMutateParagraphs()
    {
        $testFileContent = $this->postProcessFilesService
            ->execute()
            ->fetchByPath(self::TEST_INPUT_FILE_NAME)
            ->content();

        $paragraphClasses = implode(
            ' ',
            (new Crawler($testFileContent))
                ->filter('p, strong')
                ->each(function (Crawler $elm) {
                    return $elm->attr('class');
                })
        );

        $this->assertStringContainsString('paragraph', $paragraphClasses);
        $this->assertStringContainsString('paragraph--justified', $paragraphClasses);
        $this->assertStringContainsString('paragraph--bold', $paragraphClasses);
    }

    public function testExecuteWillMutateLinks()
    {
        $testFileContent = $this->postProcessFilesService
            ->execute()
            ->fetchByPath(self::TEST_INPUT_FILE_NAME)
            ->content();

        $link = (new Crawler($testFileContent))->filter('a')->first();
        $this->assertStringContainsString('link', $link->attr('class'));
        $this->assertEquals('_blank', $link->attr('target'));
    }

    public function testExecuteWillMutateNonFirstLevelHeadings()
    {
        $testFileContent = $this->postProcessFilesService
            ->execute()
            ->fetchByPath(self::TEST_INPUT_FILE_NAME)
            ->content();

        $link = (new Crawler($testFileContent))->filter('h2')->first();
        $this->assertStringContainsString('heading', $link->attr('class'));
        $this->assertStringContainsString('heading__secondary', $link->attr('class'));
    }

    private function fetchTestableInputFilesCollection(): OutputFileCollection
    {
        return new OutputFileCollection([
            new OutputFile(
                self::TEST_INPUT_FILE_NAME,
                <<<HTML
<div class="paragraphs-list">
    <h2>Wooow, look at this test heading</h2>
    <p>
        This amazing paragraph with a <strong>bold</strong> element and an amazing <a class="pretty" href="#">link</a>.
    </p>
</div>
HTML
            ),
        ]);
    }
}

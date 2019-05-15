<?php

namespace PODEntender\Application\Service\FileProcessing;

use PHPUnit\Framework\TestCase;
use PODEntender\Domain\Model\FileProcessing\OutputFile;
use PODEntender\Domain\Model\FileProcessing\OutputFileCollection;
use PODEntender\Domain\Model\FileProcessing\OutputFileRepository;
use PODEntender\Domain\Model\Post\AudioEpisode;
use PODEntender\Domain\Model\Post\AudioEpisodeCollection;
use PODEntender\Domain\Model\Post\PostCollection;
use PODEntender\Domain\Model\Post\PostRepository;
use Symfony\Component\DomCrawler\Crawler;

class PostProcessFilesTest extends TestCase
{
    const TEST_INPUT_FILE_NAME = 'test.html';

    /** @var OutputFileRepository */
    private $outputFileRepository;

    /** @var PostRepository */
    private $postRepository;

    /** @var PostProcessFiles */
    private $postProcessFilesService;

    protected function setUp(): void
    {
        $this->outputFileRepository = $this->prophesize(OutputFileRepository::class);
        $this->outputFileRepository->all()->willReturn($this->fetchTestableInputFilesCollection());

        $this->postRepository = $this->prophesize(PostRepository::class);
        $this->postRepository->withAudio()->willReturn($this->fetchTestableEpisodesCollection());

        $this->postProcessFilesService = new PostProcessFiles(
            $this->outputFileRepository->reveal(),
            $this->postRepository->reveal()
        );
    }

    public function testExecuteWillMutateParagraphs()
    {
        $testFileContent = $this->postProcessFilesService
            ->execute(true)
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
        $this->assertStringNotContainsString('paragraph--justified', $paragraphClasses);
        $this->assertStringContainsString('paragraph--bold', $paragraphClasses);
    }

    public function testExecuteWillMutateLinks()
    {
        $testFileContent = $this->postProcessFilesService
            ->execute(true)
            ->fetchByPath(self::TEST_INPUT_FILE_NAME)
            ->content();

        $link = (new Crawler($testFileContent))->filter('a')->first();
        $this->assertStringContainsString('link', $link->attr('class'));
        $this->assertEquals('_blank', $link->attr('target'));
    }

    public function testExecuteWillMutateNonFirstLevelHeadings()
    {
        $testFileContent = $this->postProcessFilesService
            ->execute(true)
            ->fetchByPath(self::TEST_INPUT_FILE_NAME)
            ->content();

        $link = (new Crawler($testFileContent))->filter('h2')->first();
        $this->assertStringContainsString('heading', $link->attr('class'));
        $this->assertStringContainsString('heading__secondary', $link->attr('class'));
    }

    public function testJekyllHeadersWontBePresentWhenProductionModeIsOff()
    {
        $testFileContent = $this->postProcessFilesService
            ->execute(false)
            ->fetchByPath(self::TEST_INPUT_FILE_NAME)
            ->content();

        $lines = explode(PHP_EOL, $testFileContent);
        $this->assertNotEquals('---', $lines[0]);
    }

    public function testJekyllHeadersWillBePresentWhenProductionModeIsOn()
    {
        $testFileContent = $this->postProcessFilesService
            ->execute(true)
            ->fetchByPath(self::TEST_INPUT_FILE_NAME)
            ->content();

        $lines = explode(PHP_EOL, $testFileContent);
        $this->assertEquals('---', $lines[0]);
        $this->assertEquals('redirect_from:', $lines[1]);
        $this->assertEquals('  - "/first/redirect"', $lines[2]);
        $this->assertEquals('  - "/second-redirect"', $lines[3]);
        $this->assertEquals('---', $lines[4]);
    }

    private function fetchTestableInputFilesCollection(): OutputFileCollection
    {
        return new OutputFileCollection([
            new OutputFile(
                self::TEST_INPUT_FILE_NAME,
                <<<HTML
<link rel="canonical" href="/test-canonical-url">
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

    private function fetchTestableEpisodesCollection(): PostCollection
    {
        $post = $this->prophesize(AudioEpisode::class);
        $post->url()->willReturn('/test-canonical-url');
        $post->redirects()->willReturn([
            '/first/redirect',
            '/second-redirect',
        ]);

        return new AudioEpisodeCollection([$post->reveal()]);
    }
}

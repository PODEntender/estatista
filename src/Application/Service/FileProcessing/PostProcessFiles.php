<?php

namespace PODEntender\Application\Service\FileProcessing;

use PODEntender\Domain\Model\FileProcessing\OutputFile;
use PODEntender\Domain\Model\FileProcessing\OutputFileCollection;
use PODEntender\Domain\Model\FileProcessing\OutputFileRepository;
use PODEntender\Domain\Model\Post\Post;
use PODEntender\Domain\Model\Post\PostRepository;
use Symfony\Component\DomCrawler\Crawler;

class PostProcessFiles
{
    private $outputFilesRepository;

    private $postRepository;

    public function __construct(OutputFileRepository $outputFilesRepository, PostRepository $postRepository)
    {
        $this->outputFilesRepository = $outputFilesRepository;
        $this->postRepository = $postRepository;
    }

    public function execute(bool $production): OutputFileCollection
    {
        $files = $this->outputFilesRepository->all();
        $processedFiles = new OutputFileCollection();

        foreach ($files as $file) {
            $crawler = new Crawler();
            $crawler->addHtmlContent($file->content());

            $this->decorateParagraphs($crawler);
            $this->decorateHeadings($crawler);

            $content = $crawler->getNode(0)->ownerDocument->saveHTML();

            if ($production) {
                $content = $this->decorateJekyllRedirects($crawler, $content);
            }

            $processedFiles->add(
                new OutputFile($file->path(), $content)
            );
        }

        return $processedFiles;
    }

    private function decorateJekyllRedirects(Crawler $crawler, string $content): string
    {
        $canonical = $crawler->filter('link[rel="canonical"]');
        if ($canonical->count() === 0) {
            return $content;
        }

        $canonicalLink = $canonical->first()->attr('href');
        $post = $this->postRepository->withAudio()->filter(function (Post $post) use ($canonicalLink) {
            return $canonicalLink === $post->url();
        })->first();

        if (is_null($post) || count($post->redirects()) === 0) {
            return $content;
        }

        $header = [
            '---' ,
            'redirect_from:',
        ];

        foreach ($post->redirects() as $redirect) {
            $header[] = sprintf('  - "%s"', parse_url($redirect)['path']);
        }

        $header[] = '---';

        return implode(PHP_EOL, $header) . PHP_EOL . $content;
    }

    private function decorateParagraphs(Crawler $crawler): void
    {
        foreach ($crawler->filter('.paragraphs-list p') as $paragraph) {
            $classes = array_merge(
                explode(' ', $paragraph->getAttribute('class')),
                ['paragraph']
            );

            $paragraph->setAttribute('class', trim(implode(' ', $classes)));
        }

        foreach ($crawler->filter('.paragraphs-list strong') as $boldItem) {
            $classes = array_merge(
                explode(' ', $boldItem->getAttribute('class')),
                ['paragraph--bold']
            );

            $boldItem->setAttribute('class', trim(implode(' ', $classes)));
        }

        foreach ($crawler->filter('.paragraphs-list a') as $linkItem) {
            $classes = array_merge(
                explode(' ', $linkItem->getAttribute('class')),
                ['link']
            );

            $linkItem->setAttribute('class', trim(implode(' ', $classes)));
            $linkItem->setAttribute('target', '_blank');
        }
    }

    private function decorateHeadings(Crawler $crawler): void
    {
        $secondaryHeadings = ['.paragraphs-list h2', '.paragraphs-list h3'];
        $filter = implode(',', $secondaryHeadings);
        foreach ($crawler->filter($filter) as $heading) {
            $classes = array_merge(
                explode(' ', $heading->getAttribute('class')),
                ['heading', 'heading__secondary']
            );

            $heading->setAttribute('class', trim(implode(' ', $classes)));
        }
    }
}

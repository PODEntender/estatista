<?php

namespace PODEntender\Application\Service\FileProcessing;

use PODEntender\Domain\Model\FileProcessing\OutputFile;
use PODEntender\Domain\Model\FileProcessing\OutputFileCollection;
use PODEntender\Domain\Model\FileProcessing\OutputFileRepository;
use Symfony\Component\DomCrawler\Crawler;

class PostProcessFiles
{
    private $outputFilesRepository;

    public function __construct(OutputFileRepository $outputFilesRepository)
    {
        $this->outputFilesRepository = $outputFilesRepository;
    }

    public function execute(): OutputFileCollection
    {
        $files = $this->outputFilesRepository->all();
        $processedFiles = new OutputFileCollection();

        foreach ($files as $file) {
            $crawler = new Crawler();
            $crawler->addHtmlContent($file->content());

            $this->decorateParagraphs($crawler);
            $this->decorateHeadings($crawler);

            $processedFiles->add(
                new OutputFile($file->path(), $crawler->getNode(0)->ownerDocument->saveHTML())
            );
        }

        return $processedFiles;
    }

    private function decorateParagraphs(Crawler $crawler): void
    {
        foreach ($crawler->filter('.paragraphs-list p') as $paragraph) {
            $classes = array_merge(
                explode(' ', $paragraph->getAttribute('class')),
                ['paragraph paragraph--justified']
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

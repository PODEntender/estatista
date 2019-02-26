<?php

namespace PODEntender\EventHandler\Episode;

use PODEntender\EventHandler\HandlerInterface;
use TightenCo\Jigsaw\Jigsaw;
use Symfony\Component\DomCrawler\Crawler;

class PostProcessFilesAfterBuild implements HandlerInterface
{
    public function handle(Jigsaw $jigsaw): void
    {
        collect($jigsaw->getOutputPaths())
            ->map(function (string $path) use ($jigsaw) {
                return $jigsaw->getDestinationPath() . $path . '/index.html';
            })
            ->filter(function (string $path) {
                return file_exists($path);
            })
            ->each(function (string $path) use ($jigsaw) {
                $builtContent = file_get_contents($path);
                $crawler = new Crawler();
                $crawler->addHtmlContent($builtContent);

                foreach ($crawler->filter('.episode__content p') as $paragraph) {
                    $classes = array_merge(
                        explode(' ', $paragraph->getAttribute('class')),
                        ['paragraph']
                    );

                    $paragraph->setAttribute('class', trim(implode(' ', $classes)));
                }

                file_put_contents($path, $crawler->html());
            });
    }
}

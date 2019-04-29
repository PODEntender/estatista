<?php

namespace PODEntender\Infrastructure\Application\StaticSite;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use PODEntender\Domain\Model\FileProcessing\OutputFile;
use PODEntender\Domain\Model\FileProcessing\OutputFileRepository;
use Symfony\Component\DomCrawler\Crawler;
use TightenCo\Jigsaw\Jigsaw;

class JigsawGenerateOldPagesAfterBuild implements JigsawEventHandler
{
    public function handle(Jigsaw $jigsaw): void
    {
        /** @var OutputFileRepository $outputFileRepository */
        $outputFileRepository = $jigsaw->app->make(OutputFileRepository::class);
        $filesystem = new Filesystem();

        $outputFileRepository->all()
            ->filter(function (OutputFile $file) {
                if (!Str::contains($file->path(), 'episodio/')) {
                    return false;
                }

                $crawler = new Crawler();
                $crawler->addHtmlContent($file->content());

                return $crawler->filter('link[rel="oldLink"]')->count();
            })
            ->each(function (OutputFile $file) use ($jigsaw, $filesystem) {
                $crawler = new Crawler();
                $crawler->addHtmlContent($file->content());

                $newFile = Str::replaceFirst(
                    'https://podentender.com',
                    $jigsaw->getDestinationPath(),
                    $crawler->filter('link[rel="oldLink"]')->first()->attr('href')
                );

                $dirname = $filesystem->dirname($newFile);
                if (!$filesystem->exists($dirname)) {
                    $filesystem->makeDirectory(
                        $filesystem->dirname($newFile),
                        0777,
                        true
                    );
                }

                $filesystem->put($newFile, $file->content());
            });
    }
}

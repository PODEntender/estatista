<?php

namespace PODEntender\EventHandler\Episode;

use PODEntender\EventHandler\HandlerInterface;
use PODEntender\Feed\FeedBuilder;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\PageVariable;

class GenerateRssFeedAfterBuild implements HandlerInterface
{
    const OUTPUT_FILE = 'feed.xml';

    public function handle(Jigsaw $jigsaw): void
    {
        $builder = (new FeedBuilder())
            ->channel()
                ->title('PODEntender')
                ->link($jigsaw->getConfig('baseUrl'))
                ->image($jigsaw->getConfig('meta.image'))
                ->category($jigsaw->getConfig('meta.category'))
                ->type('episodic')
                ->language('pt-BR')
                ->generator('PODEntender Static Blog');

        $jigsaw
            ->getCollection('episodes')
            ->filter(function (PageVariable $episode) {
                return false === is_null($episode->episode['blubrry']);
            })
            ->sortByDesc(function (PageVariable $episode) {
                return $episode->episode['number'];
            })
            ->each(function (PageVariable $episode) use ($builder, $jigsaw) {
                $builder->addItem()
                    ->title($episode->episode['title'])
                    ->link($episode->getUrl())
                    ->author($jigsaw->getConfig('meta.creatorName'))
                    ->summary($episode->episode['description'])
                    ->guid($episode->getUrl())
                    ->pubDate($episode->episode['date'])
                    ->addEnclosure()
                        ->url($episode->episode['blubrry'])
                        ->length('0') //filesize($episode->episode['blubrry']))
                        ->type('audio/mpeg');
            });

        $xmlFeed = $builder->close()->toXml();
        $file = implode(DIRECTORY_SEPARATOR, [$jigsaw->getDestinationPath(), self::OUTPUT_FILE]);

        file_put_contents($file, $xmlFeed);
    }
}

<?php

namespace PODEntender\EventHandler\Episode;

use PODEntender\EventHandler\HandlerInterface;
use PODEntender\Feed\FeedBuilder;
use PODEntender\Feed\ItemBuilder;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\PageVariable;

class GenerateRssFeedAfterBuild implements HandlerInterface
{
    const OUTPUT_FILE = 'feed.xml';

    public function handle(Jigsaw $jigsaw): void
    {
        $builder = (new FeedBuilder())
            ->channel()
                ->title($jigsaw->getConfig('feed.title'))
                ->subtitle($jigsaw->getConfig('feed.subtitle'))
                ->description($jigsaw->getConfig('feed.description'))
                ->lastBuildDate($jigsaw->getConfig('feed.lastBuildDate'))
                ->language($jigsaw->getConfig('feed.language'))
                ->generator($jigsaw->getConfig('feed.generator'))
                ->managingEditor($jigsaw->getConfig('feed.managingEditor'))
                ->imageUrl($jigsaw->getConfig('feed.imageUrl'))
                ->url($jigsaw->getConfig('feed.url'))
                ->feedUrl($jigsaw->getConfig('feed.feedUrl'))
                ->author($jigsaw->getConfig('feed.author'))
                ->explicit($jigsaw->getConfig('feed.explicit'))
                ->type($jigsaw->getConfig('feed.type'))
                ->email($jigsaw->getConfig('feed.email'))
                ->category($jigsaw->getConfig('feed.category'));

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
                    ->guid($episode->episode['guid'] ?? $episode->getUrl())
                    ->title($episode->episode['title'])
                    ->subtitle($episode->episode['description'])
                    ->description($episode->episode['description'])
                    ->author($jigsaw->getConfig('feed.author'))
                    ->link($episode->getUrl())
                    ->comments($episode->getUrl())
                    ->pubDate(date(ItemBuilder::DATE_FORMAT, $episode->episode['date']))
                    ->explicit($jigsaw->getConfig('feed.explicit'))
                    ->duration($episode->episode['duration'] ?? '00:00:00')
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

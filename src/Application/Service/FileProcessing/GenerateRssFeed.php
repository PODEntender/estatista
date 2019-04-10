<?php

namespace PODEntender\Application\Service\FileProcessing;

use PODEntender\Domain\Model\FileProcessing\RssFeedConfiguration;
use PODEntender\Domain\Model\Post\AudioEpisode;
use PODEntender\Domain\Model\Post\PostRepository;
use PODEntender\Domain\Model\Feed\ChannelBuilder;
use PODEntender\Domain\Model\Feed\FeedBuilder;
use PODEntender\Domain\Model\Feed\ItemBuilder;

class GenerateRssFeed
{
    /** @var FeedBuilder */
    private $builder;

    /** @var PostRepository */
    private $postsRepository;

    public function __construct(FeedBuilder $builder, PostRepository $postsRepository)
    {
        $this->builder = $builder;
        $this->postsRepository = $postsRepository;
    }

    public function execute(RssFeedConfiguration $configuration): void
    {
        $builder = $this->builder
            ->channel()
            ->title($configuration->title())
            ->subtitle($configuration->subtitle())
            ->description($configuration->description())
            ->lastBuildDate($configuration->lastBuildDate()->format(ChannelBuilder::DATE_FORMAT))
            ->language($configuration->language())
            ->generator($configuration->generator())
            ->managingEditor($configuration->managingEditor())
            ->imageUrl($configuration->imageUrl())
            ->url($configuration->url())
            ->feedUrl($configuration->feedUrl())
            ->author($configuration->author())
            ->explicit($configuration->explicit())
            ->type($configuration->type())
            ->email($configuration->email())
            ->category($configuration->category());

        $episodes = $this->postsRepository->withAudio()
            ->sortByDesc(function (AudioEpisode $episode) {
                return $episode->createdAt();
            });

        /** @var AudioEpisode $episode */
        foreach ($episodes as $episode) {
            $builder->addItem()
                ->guid($episode->guid())
                ->title($episode->title())
                ->subtitle($episode->description())
                ->image($episode->audioCover())
                ->description($episode->description())
                ->author($episode->author())
                ->link($episode->url())
                ->comments($episode->url())
                ->pubDate($episode->updatedAt()->format(ItemBuilder::DATE_FORMAT))
                ->explicit($configuration->explicit())
                ->duration($episode->duration())
                ->addCategory($episode->category())
                ->addEnclosure()
                ->url($episode->audioUrl())
                ->length('0')
                ->type('audio/mpeg');
        }

        $outputContent = $builder->close()->toXml();

        // @todo -> this does not belong here
        file_put_contents($configuration->outputFilepath(), $outputContent);
    }
}


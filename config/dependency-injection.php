<?php

use \Illuminate\Container\Container;

use PODEntender\Domain\Model\FileProcessing\OutputFileRepository;
use TightenCo\Jigsaw\PathResolvers\BasicOutputPathResolver;
use PODEntender\Domain\Model\FileProcessing\RssFeedConfiguration;
use PODEntender\Domain\Model\Post\PostRepository;
use PODEntender\Infrastructure\Domain\Model\Post\JigsawPostRepository;
use PODEntender\Infrastructure\Domain\Model\FileProcessing\JigsawBuiltOutputFilesRepository;
use TightenCo\Jigsaw\Jigsaw;

return function (Container $dic, Jigsaw $jigsaw) {
    /** @var array $config */
    $config = $dic->get('config');

    /** @var BasicOutputPathResolver $pathResolver */
    $pathResolver = $dic->get(BasicOutputPathResolver::class);

    $buildPath = str_replace(
        '{env}',
        $config['production'] ? 'production' : 'local',
        $dic->get('buildPath')['destination']
    );

    $dic->instance(Jigsaw::class, $jigsaw);

    $dic->instance(RssFeedConfiguration::class, new RssFeedConfiguration(
        $config['feed']['title'],
        $config['feed']['subtitle'],
        $config['feed']['description'],
        $config['feed']['lastBuildDate'],
        $config['feed']['language'],
        $config['feed']['generator'],
        $config['feed']['managingEditor'],
        $config['feed']['imageUrl'],
        $config['feed']['url'],
        $config['feed']['feedUrl'],
        $config['feed']['author'],
        $config['feed']['explicit'],
        $config['feed']['type'],
        $config['feed']['email'],
        $config['feed']['category'],
        $pathResolver->path(
            $buildPath,
            $config['feed']['outputFilepath'],
            'xml'
        )
    ));

    $dic->bind(PostRepository::class, JigsawPostRepository::class);
    $dic->bind(OutputFileRepository::class, JigsawBuiltOutputFilesRepository::class);
};

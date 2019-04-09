<?php

use TightenCo\Jigsaw\PageVariable;
use PODEntender\Helper\Url;
use PODEntender\Infrastructure\Domain\Factory\JigsawPostFactory;

return [
    'url' => new Url(),
    'getCategoryLink' => function (PageVariable $page, string $name) {
        return $page->getBaseUrl() . '/categoria/' . $name;
    },
    'makePostEntity' => function (PageVariable $page) {
        $factory = new JigsawPostFactory();

        return $factory->newPostFromPageVariable($page);
    },
    'makeAudioEpisodeEntity' => function (PageVariable $page) {
        $factory = new JigsawPostFactory();

        return $factory->newAudioEpisodeFromPageVariable($page);
    },
];

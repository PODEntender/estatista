<?php

use TightenCo\Jigsaw\PageVariable;
use PODEntender\Infrastructure\Domain\Factory\JigsawPostFactory;

return [
    'makePostEntity' => function (PageVariable $page) {
        $factory = new JigsawPostFactory();

        return $factory->newPostFromPageVariable($page);
    },
    'makeAudioEpisodeEntity' => function (PageVariable $page) {
        $factory = new JigsawPostFactory();

        return $factory->newAudioEpisodeFromPageVariable($page);
    },
];

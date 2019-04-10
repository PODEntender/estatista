<?php

namespace PODEntender\Domain\Model\Post;

use InvalidArgumentException;

class AudioEpisodeCollection extends PostCollection
{
    public function __construct(array $episodes = []) {
        $nonEpisodeItems = array_filter($episodes, function ($episode) {
            return !$episode instanceof Post;
        });

        if (count($nonEpisodeItems) > 0) {
            throw new InvalidArgumentException(
                'AudioEpisodeCollection elements must be instanceof AudioEpisode.'
            );
        }

        parent::__construct($episodes);
    }
}

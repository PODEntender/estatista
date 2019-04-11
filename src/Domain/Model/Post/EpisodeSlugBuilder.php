<?php

namespace PODEntender\Domain\Model\Post;

use Illuminate\Support\Str;

class EpisodeSlugBuilder
{
    const PREFIX = 'episodio/';

    public function build(string $episodeNumber, string $episodeTitle, ?string $episodeSlug): string
    {
        if ($episodeSlug) {
            return self::PREFIX . $episodeSlug;
        }

        $number = str_pad($episodeNumber, 3, 0, \STR_PAD_LEFT);
        $slug = Str::slug($episodeTitle, '-');

        return self::PREFIX . sprintf('%s-%s', $number, $slug);
    }
}

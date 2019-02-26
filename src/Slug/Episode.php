<?php

namespace PODEntender\Slug;

use TightenCo\Jigsaw\PageVariable;

class Episode
{
    const PREFIX = 'episodio/';

    public function __invoke(PageVariable $page)
    {
        if ($page->episode['slug']) {
            return self::PREFIX . $page->episode['slug'];
        }

        $number = str_pad($page->episode['number'], 3, 0, \STR_PAD_LEFT);
        $slug = str_slug($page->episode['title'], '-');

        return self::PREFIX . sprintf('%s-%s', $number, $slug);
    }
}

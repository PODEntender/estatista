<?php

namespace PODEntender\Helper;


use TightenCo\Jigsaw\PageVariable;

class Url
{
    public function __invoke(PageVariable $page, string $uri): string
    {
        $parts = [
            rtrim($page->baseUrl, '/'),
            ltrim($uri, '/')
        ];

        return implode('/', $parts);
    }
}

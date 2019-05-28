<?php

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

$config = [
    'production' => false,
    'baseUrl' => 'http://localhost:3000',
//    'baseUrl' => 'http://172.16.30.68:3000',
    'googleAnalyticsId' => 'GA-TEST-ID',
    'googleTagManagerId' => 'GTM-TEST-ID',
    'collections' => [
        'episodes' => [
            'path' => function (\TightenCo\Jigsaw\PageVariable $page) {
                $builder = new \PODEntender\Domain\Model\Post\EpisodeSlugBuilder();
                return $builder->build(
                    $page->episode['number'],
                    $page->episode['title'],
                    $page->episode['slug'] ?? null
                );
            },
            'sort' => ['-date'],
        ],
    ],
    'assets' => [
        'logo' => '/assets/images/logo.png',
        'icons' => [
            'menu' => '/assets/images/icons/menu.svg',
        ],
    ],
    'links' => [
        'itunes' => 'https://podcasts.apple.com/br/podcast/podentender/id1067682515',
        'spotify' => 'https://open.spotify.com/show/5awOQWYbQNkOxdrr3hgf2F',
    ],
];

return array_merge(
    $config,
    require __DIR__ . '/config/functions.php',
    [
        'feed' => require __DIR__ . '/config/feed.php',
        'menu' => require __DIR__ . '/config/menu.php',
        'meta' => require __DIR__ . '/config/meta.php',
        'robots' => require __DIR__ . '/config/robots.php',
    ]
);

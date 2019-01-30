<?php

return [
    'production' => false,
    'baseUrl' => 'http://localhost:8080',
    'menu' => [
        'items' => [
            'Todos' => '/tag/all',
            'Entrevistas' => '/tag/entrevistas',
            'News' => '/tag/news',
            'Drops' => '/tag/drops',
        ]
    ],
    'collections' => [
        'episodes' => [
            'path' => new \PODEntender\Slug\Episode(),
            'sort' => 'episode.date',
        ],
    ],

    // Helper methods
    'url' => new \PODEntender\Helper\Url(),
];

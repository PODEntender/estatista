<?php

return [
    'production' => false,
    'baseUrl' => 'http://localhost:8080',
    'collections' => [
        'episodes' => [
            'path' => new \PODEntender\Slug\Episode(),
            'sort' => 'episode.date',
        ],
    ],
];

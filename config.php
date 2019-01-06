<?php

return [
    'production' => false,
    'baseUrl' => '',
    'collections' => [
        'episodes' => [
            'path' => new \PODEntender\Slug\Episode(),
            'sort' => 'episode.date',
        ],
    ],
];

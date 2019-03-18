<?php

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

return [
    'production' => false,
    'baseUrl' => 'http://localhost:3000',
    'meta' => [
        'creatorName' => 'PODEntender',
        'title' => 'PODEntender',
        'subtitle' => 'Podcast que tem como principal objetivo apresentar e a realidade da ciência e aproximar do público brasileiro.',
        'description' => 'O PODEntender é um podcast de divulgação científica que tem como principal objetivo apresentar e aproximar a realidade da ciência brasileira para o público brasileiro. Neste podcast, nós alternamos os episódios entre três formatos de programa: 1) o PODEntender [Entrevistas], no qual trazemos cientistas brasileiros para conversar sobre seus trabalhos, o 2) PODEntender [DROPS], no qual conversamos sobre os mais diversos temas relacionado à ciência e o 3) PODEntender [NEWS], no qual comentamos notícias relacionadas ao mundo da ciência brasileira. Destacamos que esse podcast foi vencedor dos prêmios "Jaleco de Ouro" edição 2016, "Best Procastinator of the Year" edição 2017 e concorre na categoria "Mas, só estuda?" na prestigiosa premiação Lattes de Ouro deste ano.',
        'category' => 'Science &amp; Medicine',
        'image' => 'http://podentender.com/wp-content/uploads/powerpress/favcom.png',
        'email' => 'amdnsk@gmail.com',
    ],
    'menu' => [
        'items' => [
            'Todos' => '/categoria/todos',
            'Entrevistas' => '/categoria/entrevista',
            'News' => '/categoria/news',
            'Drops' => '/categoria/drops',
        ],
        'social' => [
            'Facebook' => 'https://www.facebook.com/podentender',
            'Instagram' => 'https://www.instagram.com/podentender',
            'Twitter' => 'https://www.twitter.com/podentender',
        ],
    ],
    'collections' => [
        'episodes' => [
            'path' => new \PODEntender\Slug\Episode(),
            'sort' => ['-date'],
        ],
    ],

    // Helper methods
    'url' => new \PODEntender\Helper\Url(),

    'assets' => [
        'logo' => '/assets/images/logo.png',
        'icons' => [
            'menu' => '/assets/images/icons/menu.svg',
        ],
    ],
];

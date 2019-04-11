@php
$episodes = [
    'Entrevistas' => $latestEpisodesPerCategory['Entrevista'],
    'Drops' => $latestEpisodesPerCategory['Drops'],
    'News' => $latestEpisodesPerCategory['News'],
];
@endphp

<section class="content">
    <h1 class="heading heading__primary">
        Em Destaque
    </h1>
    @include('_partials.episode.episode-card', [
        'classes' => [
            'episode-card--no-padding',
            'image' => [
                'episode-card__cover--taller',
            ],
        ],
        'episode' => [
            'url' => $lastEpisode->url(),
            'image' => $lastEpisode->cover(),
            'timestamp' => $lastEpisode->createdAt()->getTimestamp(),
            'title' => $lastEpisode->title(),
            'description' => $lastEpisode->description(),
        ],
    ])

    @foreach($episodes as $categoryName => $categoryEpisodes)
        @include('_partials.episode.recommendations.main', [
            'title' => $categoryName,
            'recommendations' => $categoryEpisodes,
        ])
    @endforeach
</section>

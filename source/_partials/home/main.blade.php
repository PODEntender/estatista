@php
$episodes = [
    'Entrevistas' => $latestEpisodesPerCategory['Entrevista'],
    'Drops' => $latestEpisodesPerCategory['Drops'],
    'News' => $latestEpisodesPerCategory['News'],
];

@endphp

<section class="content">
    @include('_partials.episode.episode-card-list', [
        'title' => 'Em destaque',
        'episodes' => [$lastEpisode],
        'hidden' => ['description']
    ])

    @foreach($episodes as $categoryName => $categoryEpisodes)
        @include('_partials.episode.recommendations.main', [
            'title' => $categoryName,
            'recommendations' => $categoryEpisodes,
        ])
    @endforeach
</section>

@php
$episodes = [
    'Entrevistas' => $latestEpisodesPerCategory['Entrevista'],
    'Drops' => $latestEpisodesPerCategory['Drops'],
    'News' => $latestEpisodesPerCategory['News'],
];

@endphp

<section class="content">
    @include('_partials.episode.episode-card-list', [
        'title' => 'Destaque',
        'episodes' => [$lastEpisode],
        'hidden' => ['description']
    ])

    @foreach($episodes as $categoryName => $categoryEpisodes)
        @include('_partials.episode.episode-card-compact-list', [
            'title' => $categoryName,
            'episodes' => $categoryEpisodes,
            'hidden' => ['description']
        ])
    @endforeach
</section>

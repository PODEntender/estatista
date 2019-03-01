<section class="content">
    @include('_partials.episode.list', [
        'title' => 'Último episódio',
        'episodes' => [$lastEpisode],
        'hidden' => ['description']
    ])

    @include('_partials.episode.list', [
        'title' => 'Entrevistas',
        'episodes' => [],
        'hidden' => ['description', 'timestamp']
    ])

    @include('_partials.episode.list', [
        'title' => 'Drops',
        'episodes' => [],
        'hidden' => ['description', 'timestamp']
    ])

    @include('_partials.episode.list', [
        'title' => 'News',
        'episodes' => [],
        'hidden' => ['description', 'timestamp']
    ])
</section>

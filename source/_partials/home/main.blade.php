<section class="content">
    @include('_partials.episode.list', [
        'title' => 'Último episódio',
        'episodes' => [$lastEpisode],
        'hidden' => ['description']
    ])
</section>

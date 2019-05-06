<article class="content">
    @include('_partials.components.sticky-share', [
        'url' => $page->getUrl(),
        'title' => 'Olha que onda o episódio ' . $page->episode['title'] . ': ',
    ])
    @include('_partials.episode.cover.main')
    @include('_partials.episode.player')
    <section class="paragraphs-list">
        @yield('content')

        @include('_partials.episode.commented')
    </section>

    @include('_partials.episode.comments')

    @include('_partials.episode.recommendations.main', [
        'classes' => [
            'gtm-view-recommended-list',
        ],
        'recommendations' => $page->recommendations,
    ])
</article>

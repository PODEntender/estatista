<a role="article" href="{{ $episode['url'] ?? '#' }}" class="episode-card {{ implode(' ', $classes ?? []) }}">
    @if($episode['image'])
        @include('_partials.components.image', [
            'url' => $episode['image'],
            'alt' => $episode['title'],
            'title' => $episode['title'],
            'classes' => [
                'episode-card__cover'
            ],
        ])
    @endif

    @if($episode['title'])
    <h2 class="episode-card__title">
        {{ $episode['title'] }}
    </h2>
    @endif

    @if($episode['timestamp'])
    <time  class="episode-card__release-date" datetime="{{ date('Y-m-d', $episode['timestamp']) }}">
        {{ date('d \d\e F \d\e Y', $episode['timestamp']) }}
    </time>
    @endif

    @if($episode['description'])
    <p class="paragraph">{{ $episode['description'] }}</p>
    @endif
</a>

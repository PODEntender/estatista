<a title="{{ $episode['title'] }}" role="article" href="{{ $episode['url'] ?? '#' }}" class="episode-card {{ implode(' ', array_filter($classes ?? [], 'is_string')) }}">
    @if($episode['image'])
        <div class="episode-card__cover-container">
            @include('_partials.components.image', [
                'url' => $episode['image'],
                'alt' => $episode['title'],
                'title' => $episode['title'],
                'classes' => array_merge([
                    'episode-card__cover',
                ], $classes['image'] ?? []),
            ])
        </div>
    @endif

    @if($episode['title'])
    <h2 class="episode-card__title">
        {{ $episode['title'] }}
    </h2>
    @endif

    @if($episode['timestamp'])
    <time  class="episode-card__release-date" datetime="{{ date('Y-m-d', $episode['timestamp']) }}">
        {{ strftime('%d de %B de %Y', $episode['timestamp']) }}
    </time>
    @endif

    @if($episode['description'])
    <p class="paragraph">{{ $episode['description'] }}</p>
    @endif
</a>

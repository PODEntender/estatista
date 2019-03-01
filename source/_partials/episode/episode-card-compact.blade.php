<a role="article" href="{{ $episode['url'] ?? '#' }}" class="episode-card-compact">
    <div class="episode-card-compact__cover-container">
        <div class="episode-card-compact__cover-image-container">
            @if($episode['image'])
                <img class="episode-card-compact__cover-image" data-src="{{ $episode['image'] }}" alt="{{ $episode['title'] }}">
            @endif
        </div>

        <div class="episode-card-compact__description-container">
            @if($episode['title'])
            <h2 class="episode-card-compact__title">
                {{ $episode['title'] }}
            </h2>
            @endif

            @if($episode['timestamp'])
            <time  class="episode-card-compact__release-date" datetime="{{ date('Y-m-d', $episode['timestamp']) }}">
                {{ date('d \d\e F \d\e Y', $episode['timestamp']) }}
            </time>
            @endif

        </div>
    </div>

    @if($episode['description'])
    <p class="paragraph">{{ $episode['description'] }}</p>
    @endif
</a>

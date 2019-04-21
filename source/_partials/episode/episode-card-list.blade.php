@if(count($episodes) > 0)
<section class="episode-card-list {{ implode(' ', $classes ?? []) }}">
    @if($title)
    <h1 class="episode-card-list__title">
        {{ $title  }}
    </h1>
    @endif

    <ul class="episode-card-list__list">
        @foreach($episodes as $episode)
            <li class="episode-card-list__list-item">
                @include('_partials.episode.episode-card', [
                    'classes' => [
                        'episode-card--no-padding',
                    ],
                    'episode' => $episode,
                ])
            </li>
        @endforeach
    </ul>
</section>
@endif

@php
$hidden = $hidden ?? [];
$show = function (string $field) use ($hidden) {
    return !in_array($field, $hidden);
};

$field = function (string $name, string $value, string $default = '') use ($show) {
    if (false === $show($name)) {
        return null;
    }

    return $value ? $value : $default;
};
@endphp

@if(count($episodes) > 0)
<section class="episode-card-list">
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
                    'episode' => [
                        'url' => $field('url', $episode->getUrl(), '#'),
                        'image' => $field('image', $page->baseUrl . $episode->episode['cover']['url']),
                        'timestamp' => $field('timestamp', $episode->episode['date']),
                        'title' => $field(
                            'title',
                            "Episódio #{$episode->episode['number']} - {$episode->episode['title']}"
                        ),
                        'description' => $field('description', $episode->episode['description']),
                    ],
                ])
            </li>
        @endforeach
    </ul>
</section>
@endif
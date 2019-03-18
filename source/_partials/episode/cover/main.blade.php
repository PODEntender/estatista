<header class="episode__cover">
    @include('_partials.components.image', [
        'url' => $page->getBaseUrl() . $page->episode['cover']['url'],
        'alt' => $page->episode['cover']['title'],
        'title' => $page->episode['cover']['title'],
        'classes' => [
            'episode__cover__image'
        ],
    ])

    <h1 class="heading heading__primary">
        Episódio #{{ str_pad($page->episode['number'], 3, '0', STR_PAD_LEFT) }} - {{ $page->episode['title'] }}
    </h1>

    <small class="episode__cover__details">
        <time property="na:datePublished" datetime="{{ $page->episode['date'] }}" pubdate="pubdate">
            {{ date('d \d\e F \d\e Y', $page->episode['date']) }}
        </time>
        | em <a class="episode__cover__details--bold link" href="{{ $page->baseUrl }}/categoria/{{ strtolower($page->category) }}">{{ $page->category }}</a>
    </small>
</header>

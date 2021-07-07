<a title="{{ $author['name'] }}" href="{{ $page->baseUrl . '/autores/' . $author['uid'] }}" class="author-card">
    @include('_partials.components.image', [
    'url' => $author['picture'],
    'alt' => $author['name'],
    'title' => $author['name'],
    'classes' => ['author-card__cover'],
    ])

    <h2 class="author-card__name">{{ $author['name'] }}</h2>
    <p class="author-card__description">{{ $author['description'] }}</p>
</a>

@include('_partials.components.image', [
    'url' => $page->baseUrl . $url,
    'alt' => $alt,
    'title' => $title,
    'classes' => [
        'lazy-image',
        'responsive-image',
    ],
])
<p class="responsive-image__subtitle">{{ $title }}</p>

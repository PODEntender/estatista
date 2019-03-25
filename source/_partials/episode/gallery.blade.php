<section class="episode__gallery">
    @foreach($items as $item)
        <figure class="episode__gallery-item">
                <a href="{{ $page->baseUrl . $item['url'] }}" target="_blank">
                        @include('_partials.components.image', [
                                'url' => $page->baseUrl . $item['url'],
                                'alt' => $item['alt'],
                                'title' => $item['title'],
                                'classes' => [
                                    'lazy-image',
                                    'responsive-image',
                                ],
                        ])
                </a>
                <figcaption class="episode__gallery-item-caption">{{ $item['title'] }}</figcaption>
        </figure>
    @endforeach
</section>

@php

$classes = $classes ?? [];
$classes = array_unique($classes);

$blankImage = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkqAcAAIUAgUW0RjgAAAAASUVORK5CYII=';

@endphp
<noscript>
    <img src="{{ $url }}" alt="{{ $alt }}" title="{{ $title }}" class="{{ implode(' ', $classes) }}">
</noscript>

<img data-src="{{ $url }}" src="{{ $blankImage }}" alt="{{ $alt }}" title="{{ $title }}" class="{{ implode(' ', array_merge($classes, ['lazy-image'])) }}">

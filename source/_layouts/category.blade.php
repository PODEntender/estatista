@extends('_layouts.master')

@php
$metaDescription = 'Episódios: ' . implode(
    ';',
    $pagination->items
        ->map(function ($episode) {
            return $episode->episode['title'];
        })
        ->toArray()
);

@endphp

@section('head')
<title>
    {{ $page->pagination->collection }} | Página {{ $pagination->currentPage }} de {{ $pagination->totalPages }} | {{ $page->meta['title'] }}
</title>

<meta name="description" content="{{ $metaDescription }}">
<meta name="keywords" content="{{ implode(',', $page->tags) }}">
<meta name="author" content="{{ $page->baseUrl }}">
<meta name="publisher" content="{{ $page->baseUrl }}">

<meta property="og:title" content="{{ $page->episode['title'] }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:image" content="{{ $page->episode['cover']['url'] }}">
<meta property="og:url" content="{{ $page->getUrl() }}">

<meta name="twitter:card" content="{{ $page->meta['twitter']['card'] }}">
<meta name="twitter:site" content="{{ $page->meta['twitter']['account'] }}">
<meta name="twitter:creator" content="{{ $page->meta['twitter']['account'] }}">
<meta name="twitter:title" content="{{ $page->episode['title'] }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
<meta name="twitter:image" content="{{ $page->episode['cover']['url'] }}">
<meta name="twitter:url" content="{{ $page->getUrl() }}">

<link rel="canonical" href="{{ $page->getUrl() }}">

@include('_partials.meta.json-ld-script', [
    'schema' => [
        '@context' => 'http://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'item' => [
                    '@type' =>'WebPage',
                    '@id' => $page->getBaseUrl(),
                    'name' => $page->meta['title'],
                    'image' => $page->meta['image'],
                ],
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'item' => [
                    '@type' =>'CollectionPage',
                    '@id' => $page->getUrl(),
                    'name' => $page->pagination->collection,
                    'image' => $page->meta['image'],
                ],
            ],
            [
                '@type' => 'ListItem',
                'position' => 3,
                'item' => [
                    '@type' =>'CollectionPage',
                    '@id' => $page->getUrl() . '#pg',
                    'name' => sprintf('Categoria: %s, Página: %s', $page->pagination->collection, $pagination->currentPage),
                    'image' => $page->meta['image'],
                ],
            ],
        ]
    ]
])
@endsection

@section('body')
    @include('_partials.layout.header.navbar')

    <article class="content">
        <h1 class="heading heading__primary">
            Categoria: {{ $page->pagination->collection }}
        </h1>

        @include('_partials.components.pagination', [
            'pages' => $pagination->pages,
            'currentPage' => $pagination->currentPage,
            'previousPath' => $pagination->previous,
            'nextPath' => $pagination->next,
        ])

        @include('_partials.episode.episode-card-list', [
            'title' => '',
            'episodes' => $pagination->items,
            'hidden' => [],
        ])

        @include('_partials.components.pagination', [
            'pages' => $pagination->pages,
            'currentPage' => $pagination->currentPage,
            'previousPath' => $pagination->previous,
            'nextPath' => $pagination->next,
        ])
    </article>

    @include('_partials.layout.sidemenu.sidemenu')
    @include('_partials.layout.footer.footer')

    <link rel="stylesheet" href="{{ $page->getBaseUrl() }}/assets/build/css/main.css">
    <script src="{{ $page->getBaseUrl() }}/assets/build/js/main.js" async></script>
@endsection

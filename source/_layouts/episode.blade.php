@extends('_layouts.master')

@section('head')
<title>
    Episódio #{{ str_pad($page->episode['number'], 3, '0', STR_PAD_LEFT) }} - {{ $page->episode['title'] }} | {{ $page->meta['title'] }}
</title>

<meta name="description" content="{{ $page->episode['description'] }}">
<meta name="keywords" content="{{ implode(',', $page->tags ?? []) }}">
<meta name="author" content="{{ $page->baseUrl }}">
<meta name="publisher" content="{{ $page->baseUrl }}">

<meta property="og:title" content="{{ $page->episode['title'] }}">
<meta property="og:description" content="{{ $page->episode['description'] }}">
<meta property="og:image" content="{{ $page->getBaseUrl() . $page->episode['cover']['url'] }}">
<meta property="og:url" content="{{ $page->getUrl() }}">

<meta name="twitter:card" content="{{ $page->meta['twitter']['card'] }}">
<meta name="twitter:site" content="{{ $page->meta['twitter']['account'] }}">
<meta name="twitter:creator" content="{{ $page->meta['twitter']['account'] }}">
<meta name="twitter:title" content="{{ $page->episode['title'] }}">
<meta name="twitter:description" content="{{ $page->episode['description'] }}">
<meta name="twitter:image" content="{{ $page->getBaseUrl() . $page->episode['cover']['url'] }}">
<meta name="twitter:url" content="{{ $page->getUrl() }}">

<link rel="canonical" href="{{ $page->getUrl() }}">
@if ($page->oldLink)
<link rel="oldLink" href="{{ $page->oldLink }}">
@endif

@include('_partials.meta.json-ld-script', [
    'schema' => [
        '@context' => 'http://schema.org',
        '@type' => 'Article',
        'name' => 'Episódio #'. str_pad($page->episode['number'], 3, '0', STR_PAD_LEFT) . ' - '. $page->episode['title'] . ' | ' . $page->meta['title'],
        'description' => $page->episode['description'],
        'image' => [$page->getBaseUrl() . $page->episode['cover']['url']],
        'url' => $page->getUrl(),
        'datePublished' => date('Y-m-d', $page->episode['date']),
        'headline' => substr($page->episode['title'], 0, 110),
        'author' => $page->meta['schemas']['author'],
        'publisher' => $page->meta['schemas']['author'],
        'dateModified' => date('Y-m-d', time()),
    ],
])

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
                    '@type' =>'WebPage',
                    '@id' => $page->getUrl(),
                    'name' => $page->episode['title'],
                    'image' => $page->getBaseUrl() . $page->episode['cover']['url'],
                ],
            ],
        ],
    ]
])
@endsection

@section('body')
    @include('_partials.layout.header.navbar')

    @include('_partials.episode.main')

    @include('_partials.layout.sidemenu.sidemenu')
    @include('_partials.layout.footer.footer')

    <link rel="stylesheet" href="{{ $page->getBaseUrl() }}/assets/build/css/main.css?{{ date('YmdHis') }}">
    <script src="{{ $page->getBaseUrl() }}/assets/build/js/main.js?{{ date('YmdHis') }}" async></script>
@endsection

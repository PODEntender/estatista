@extends('_layouts.master')

@section('head')
<title>{{ $page->meta['title'] }}</title>

<meta name="description" content="{{ $page->meta['description'] }}">
<meta name="author" content="{{ $page->baseUrl }}">
<meta name="publisher" content="{{ $page->baseUrl }}">

<meta name="og:title" content="{{ $page->meta['title'] }}">
<meta name="og:description" content="{{ $page->meta['description'] }}">
<meta name="og:image" content="{{ $page->baseUrl . $page->assets->logo }}">
<meta name="og:url" content="{{ $page->baseUrl }}">

<meta name="twitter:card" content="{{ $page->meta['twitter']['card'] }}">
<meta name="twitter:site" content="{{ $page->meta['twitter']['account'] }}">
<meta name="twitter:creator" content="{{ $page->meta['twitter']['account'] }}">
<meta name="twitter:title" content="{{ $page->meta['title'] }}">
<meta name="twitter:description" content="{{ $page->meta['description'] }}">
<meta name="twitter:image" content="{{ $page->baseUrl . $page->assets->logo }}">
<meta name="twitter:url" content="{{ $page->baseUrl }}">

<link rel="canonical" href="{{ $page->baseUrl }}">

@include('_partials.meta.json-ld-script', [
    'schema' => [
        '@context' => 'http://schema.org',
        '@type' => 'Organization',
        'name' => $page->meta['schemas']['author']['name'],
        'url' => $page->getBaseUrl(),
        'logo' => [
            '@type' => 'ImageObject',
            'url' => $page->meta['schemas']['author']['logo'],
        ],
        'contactPoint' => [
            '@type' => 'ContactPoint',
            'url' => $page->meta['schemas']['author']['contactPoint']['url'],
            'email' => $page->meta['schemas']['author']['contactPoint']['email'],
            'contactType' => $page->meta['schemas']['author']['contactPoint']['contactType'],
        ],
        'sameAs' => $page->meta['schemas']['author']['sameAs'],
    ],
])

@endsection

@section('body')
    @include('_partials.layout.header.navbar')

    @include('_partials.home.main')

    @include('_partials.layout.sidemenu.sidemenu')
    @include('_partials.layout.footer.footer')

    <link rel="stylesheet" href="{{ $page->getBaseUrl() }}/assets/build/css/main.css?{{ date('YmdHis') }}">
    <script src="{{ $page->getBaseUrl() }}/assets/build/js/main.js?{{ date('YmdHis') }}" async></script>
@endsection

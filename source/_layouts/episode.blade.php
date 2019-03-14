@extends('_layouts.master')

@section('head')
<title>
    Episódio #{{ str_pad($page->episode['number'], 3, '0', STR_PAD_LEFT) }} - {{ $page->episode['title'] }} | {{ $page->meta['title'] }}
</title>

<meta name="description" content="{{ $page->episode['description'] }}">
<meta name="keywords" content="{{ implode(',', $page->tags) }}">
<meta name="author" content="{{ $page->baseUrl }}">
<meta name="publisher" content="{{ $page->baseUrl }}">

<meta name="og:title" content="{{ $page->episode['title'] }}">
<meta name="og:description" content="{{ $page->episode['description'] }}">
<meta name="og:image" content="{{ $page->episode['cover']['url'] }}">
<meta name="og:url" content="{{ $page->getUrl() }}">

<meta name="twitter:title" content="{{ $page->episode['title'] }}">
<meta name="twitter:description" content="{{ $page->episode['description'] }}">
<meta name="twitter:image" content="{{ $page->episode['cover']['url'] }}">
<meta name="twitter:url" content="{{ $page->getUrl() }}">

<link rel="canonical" href="{{ $page->getUrl() }}">
@endsection

@section('body')
    @include('_partials.layout.header.navbar')

    @include('_partials.episode.main')

    @include('_partials.layout.sidemenu.sidemenu')
    @include('_partials.layout.footer.footer')

    <link rel="stylesheet" href="{{ $page->getBaseUrl() }}/assets/build/css/main.css">
    <script src="{{ $page->getBaseUrl() }}/assets/build/js/main.js" async></script>
@endsection

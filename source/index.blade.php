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

<meta name="twitter:title" content="{{ $page->meta['title'] }}">
<meta name="twitter:description" content="{{ $page->meta['description'] }}">
<meta name="twitter:image" content="{{ $page->baseUrl . $page->assets->logo }}">
<meta name="twitter:url" content="{{ $page->baseUrl }}">

<link rel="canonical" href="{{ $page->baseUrl }}">
@endsection

@section('body')
    @include('_partials.layout.header.navbar')

    @include('_partials.home.main')

    @include('_partials.layout.sidemenu.sidemenu')
    @include('_partials.layout.footer.footer')

    <link rel="stylesheet" href="{{ $page->getBaseUrl() }}/assets/build/css/main.css">
    <script src="{{ $page->getBaseUrl() }}/assets/build/js/main.js" async></script>
@endsection

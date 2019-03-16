@extends('_layouts.master')

@section('head')
<title>
    {{ $page->pagination->collection }} | Página {{ $pagination->currentPage }} de {{ $pagination->totalPages }} | {{ $page->meta['title'] }}
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

    <article class="content">
        <h1 class="heading heading__primary">
            {{ $page->pagination->collection }}
        </h1>

        @include('_partials.episode.episode-card-list', [
            'title' => '',
            'episodes' => $pagination->items,
            'hidden' => [],
        ])
    </article>

    @include('_partials.layout.sidemenu.sidemenu')
    @include('_partials.layout.footer.footer')

    <link rel="stylesheet" href="{{ $page->getBaseUrl() }}/assets/build/css/main.css">
    <script src="{{ $page->getBaseUrl() }}/assets/build/js/main.js" async></script>
@endsection

@extends('_layouts.master')

@section('head')
<title>
    PODEntender #{{ str_pad($page->episode['number'], 3, '0', STR_PAD_LEFT) }} - {{ $page->episode['title'] }}
</title>
@endsection

@section('body')
    @include('_partials.layout.header.navbar')
    @include('_partials.layout.sidemenu.sidemenu')
    @include('_partials.episode.main')
    @include('_partials.layout.footer.footer')

    <link rel="stylesheet" href="{{ $page->getBaseUrl() }}/assets/build/css/main.css">
    <script src="{{ $page->getBaseUrl() }}/assets/build/js/main.js" async></script>
@endsection

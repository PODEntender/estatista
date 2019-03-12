@extends('_layouts.master')

@section('head')
    <title>{{ $page->meta['title'] }}</title>
@endsection

@section('body')
    @include('_partials.layout.header.navbar')

    @include('_partials.home.main')

    @include('_partials.layout.sidemenu.sidemenu')
    @include('_partials.layout.footer.footer')

    <link rel="stylesheet" href="{{ $page->getBaseUrl() }}/assets/build/css/main.css">
    <script src="{{ $page->getBaseUrl() }}/assets/build/js/main.js" async></script>
@endsection

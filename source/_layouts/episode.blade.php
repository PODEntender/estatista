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
    @include('_partials.episode.recommendations.main')
    @include('_partials.layout.footer.footer')

    <link rel="stylesheet" href="/assets/build/css/main.css">
@endsection

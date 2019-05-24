@extends('_layouts.master')
@section('head')
<title>
    {{ $page->author['name'] }} | {{ $page->meta['title'] }}
</title>

<meta name="description" content="{{ $page->meta['description'] }}">
<meta name="author" content="{{ $page->baseUrl }}">
<meta name="publisher" content="{{ $page->baseUrl }}">

<meta property="og:type" content="website">
<meta property="og:title" content="{{ $page->meta['title'] }}">
<meta property="og:url" content="{{ $page->getUrl() }}">
<meta property="og:locale" content="{{ $page->meta['locale'] }}">
<meta property="og:description" content="{{ $page->meta['description'] }}">
<meta property="og:image" content="{{ $page->baseUrl . $page->meta['image'] }}">
<meta property="og:image:secure_url" content="{{ $page->baseUrl . $page->meta['image'] }}">
<meta property="og:image:alt" content="{{ $page->meta['description'] }}">

<meta name="twitter:card" content="{{ $page->meta['twitter']['card'] }}">
<meta name="twitter:site" content="{{ $page->meta['twitter']['account'] }}">
<meta name="twitter:creator" content="{{ $page->meta['twitter']['account'] }}">
<meta name="twitter:title" content="{{ $page->meta['title'] }}">
<meta name="twitter:description" content="{{ $page->meta['description'] }}">
<meta name="twitter:image" content="{{ $page->baseUrl . $page->author['picture'] }}">
<meta name="twitter:url" content="{{ $page->baseUrl }}">

<link rel="canonical" href="{{ $page->getUrl() }}">
@endsection

@section('body')
    @include('_partials.layout.header.navbar')

    <section class="content">
        <div class="author">
            <img class="author__picture" src="{{ $page->baseUrl . $page->author['picture'] }}" alt="{{ $page->author['name'] }}">

            <div class="paragraphs-list author__bio">
                <h1 class="heading heading__primary paragraph--left">{{ $page->author['name'] }}</h1>
                <p class="paragraph paragraph--bold">{{ $page->author['description'] }}</p>

                @yield('content')
            </div>
        </div>

        <br>

        @include('_partials.episode.episode-card-list', [
            'title' => 'Participação em episódios',
            'episodes' => $page->episodes->map(function ($page) {
                /** @var \PODEntender\Domain\Model\Post\AudioEpisode $episode */
                $episode = $page->audioEpisode;

                return [
                    'url' => $episode->url(),
                    'image' => $episode->cover(),
                    'timestamp' => $episode->createdAt()->getTimestamp(),
                    'title' => $episode->title(),
                    'description' => '',
                ];
            })->toArray(),
            'hidden' => [],
        ])
    </section>

    @include('_partials.layout.sidemenu.sidemenu')
    @include('_partials.layout.footer.footer')

    <link rel="stylesheet" href="{{ $page->getBaseUrl() }}/assets/build/css/main.css?{{ date('YmdHis') }}">
    <script src="{{ $page->getBaseUrl() }}/assets/build/js/main.js?{{ date('YmdHis') }}" async></script>
@endsection

@extends('_layouts.master')

@section('head')
    <title>{{ $page->meta['title'] }}</title>
@endsection

@section('body')
    @include('_partials.layout.header.navbar')

    <section class="content">
        <img class="responsive-image" src="{{ $page->getBaseUrl() }}/assets/images/not-found.webp" alt="Um GIF engraçadinho com duas pessoas balançando a cebeça dizendo que 'não'.">

        <h1 class="heading heading__primary paragraph--left">
            404 - Página não encontrada
        </h1>

        <p class="paragraph">
            Perainda! Algo de errado não está certo...
        </p>
        <p class="paragraph">
            Provavelmente, assim, só acho, você está procurando um conteúdo que mei que num existe.
        </p>
        <p class="paragraph paragraph--bold">
            Mas não se preocupe!!
        </p>
        <p class="paragraph">
            A <span class="paragraph--bold">Janete</span> está vendo tudo e já nos avisou! Loguinho loguinho a gente vai
            resolver mais esta peleja!
        </p>

        <p class="paragraph">
            Enquanto isso não acontece, a Carol Lacerda falou que
            <a class="link" href="{{ $page->getBaseUrl() }}/categoria/todos">perguntaram de você aqui...</a>👀
        </p>
    </section>

    @include('_partials.layout.sidemenu.sidemenu')
    @include('_partials.layout.footer.footer')

    <link rel="stylesheet" href="{{ $page->getBaseUrl() }}/assets/build/css/main.css">
    <script src="{{ $page->getBaseUrl() }}/assets/build/js/main.js" async></script>
@endsection

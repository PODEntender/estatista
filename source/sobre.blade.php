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

    <article class="content">
        <h1 class="heading heading__primary">
            Sobre o PODEntender
        </h1>

        <br>

        <section class="paragraphs-list">
            <h2 class="heading heading__secondary">
                Num resumo bem curto!
            </h2>
            <p class="paragraph">
                O PODEntender é uma iniciativa independente de divulgação da ciência Brasileira.
                Nosso principal objetivo é mostrar a todo Brasileiro como funciona o processo de
                produção científica, e mostrar que a ciência não é nenhum bicho de sete cabeças.
            </p>
            <p class="paragraph">
                A gente torna a ciência simples de entender e quer fazer todo mundo conhecer.
                Queremos ver o Brasileiro sonhando em ser cientista, e também votando por educação
                e investimento em ciência.
            </p>
            <p class="paragraph paragraph--italic">
                A gente tá aqui pra mostrar que está tudo bem dizer “não sei” pra muita coisa.
                Mas a gente sempre <strong class="paragraph--bold">pode entender</strong> tudo!
            </p>

            <h2 class="heading heading__secondary">
                O cenário da ciência no Brasil
            </h2>
            <p class="paragraph">
                Enxergamos que há uma distância muito grande entre os cientistas e as demais
                pessoas na sociedade, e que existe um mito que faz com que pensemos que nem todo
                mundo pode ser cientista. Não por menos: o investimento em educação, ciência e
                tecnologia no Brasil são risíveis e forçam grande parte dos nossos cientistas a
                saírem do país em busca de condições decentes de emprego.
            </p>
            <p class="paragraph">
                E ainda assim o Brasil é referência em produção científica em diversas áreas
                do conhecimento. O povo Brasileiro conta com profissionais altamente capacitados
                que desenvolvem ano após ano projetos que deixam muito país de primeiro mundo
                de queixo caído!
            </p>

            <h2 class="heading heading__secondary">
                O que faz o PODEntender?
            </h2>
            <p class="paragraph">
                O trabalho do PODEntender é justamente mostrar a todos que qualquer pessoa pode
                fazer ciência e <strong class="paragraph--bold">pode entender</strong> ciência.
                E a nossa principal forma de mostrar isso é entrevistando cientistas Brasileiros,
                mostrando a sua história desde a infância até o presente e qual caminho
                percorreram até se tornarem cientistas.
            </p>
            <p class="paragraph">
                Buscamos trazer de forma leve, clara e engraçada temas importantes para a ciência
                Brasileira e para o Brasil nos formatos de áudio, publicações e notícias.
            </p>

            <h2 class="heading heading__secondary">
                Então bora começar a ouvir!
            </h2>
            <p class="paragraph">
                A gente lança um episódio no formato podcast a cada 2 semanas, que você pode encontrar
                e ouvir gratuitamente na nossa página, no iTunes ou no Spotify.
            </p>
        </section>
    </article>


    @include('_partials.layout.sidemenu.sidemenu')
    @include('_partials.layout.footer.footer')

    <link rel="stylesheet" href="{{ $page->getBaseUrl() }}/assets/build/css/main.css">
    <script src="{{ $page->getBaseUrl() }}/assets/build/js/main.js" async></script>
@endsection

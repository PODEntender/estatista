@extends('_layouts.master')

@section('head')
<title>Sobre o PODEntender</title>

<meta name="description" content="{{ $page->meta['description'] }}">
<meta name="author" content="{{ $page->baseUrl }}">
<meta name="publisher" content="{{ $page->baseUrl }}">

<meta property="og:title" content="{{ $page->meta['title'] }}">
<meta property="og:url" content="{{ $page->baseUrl . '/sobre/' }}">
<meta property="og:type" content="website">
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
<meta name="twitter:image" content="{{ $page->baseUrl . $page->meta['twitter']['image'] }}">
<meta name="twitter:url" content="{{ $page->baseUrl }}">

<link rel="canonical" href="{{ $page->getUrl() }}">

@include('_partials.meta.json-ld-script', [
    'schema' => [
        '@context' => 'http://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'item' => [
                    '@type' =>'WebPage',
                    '@id' => $page->getBaseUrl(),
                    'name' => $page->meta['title'],
                    'image' => $page->meta['image'],
                ],
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'item' => [
                    'type' => 'AboutPage',
                    '@id' => $page->getUrl(),
                    'name' => 'Sobre o PODEntender',
                    'image' => $page->meta['image'],
                ]
            ],
        ]
    ]
])
@endsection

@section('body')
    @include('_partials.layout.header.navbar')

    <article class="content">
        <h1 class="heading heading__primary">
            Sobre o PODEntender
        </h1>

        <section class="paragraphs-list">
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
                E quem faz o PODEntender?
            </h2>

            <br>
            @include('_partials.authors.author-card-list', ['authors' => $page->allAuthors])
            <br>

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

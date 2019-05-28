@extends('_layouts.master')

@section('head')
    <title>Perguntas Frequentes - FAQ</title>

    <meta name="description" content="{{ $page->meta['description'] }}">
    <meta name="author" content="{{ $page->baseUrl }}">
    <meta name="publisher" content="{{ $page->baseUrl }}">

    <meta property="og:title" content="{{ $page->meta['title'] }}">
    <meta property="og:url" content="{{ $page->getUrl() }}">
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

@endsection

@section('body')
    @include('_partials.layout.header.navbar')

    <article class="content">
        <h1 class="heading heading__primary">
            Perguntas Frequentes
        </h1>
        <p class="paragraph">
            Você aí tem se feito perguntas e sofrido ao buscar respostas, atravessando noites em claro e torcendo por um
            grande momento de alumiação que lhe force verbalizar em alto e bom tom o dizer "Eureca!" e que traga paz
            para o seu espírito questionador?
        </p>
        <p class="paragraph">
            Poisé, a gente não vai prometer tanto assim! Mas nesta página aqui você encontra algumas questões difíceis
            da humanidade as quais a equipe do
            <a href="{{ $page->baseUrl }}" target="_blank" class="link">maior podcast em linha reta da América Latina</a>
            se propôs a desvendar para ao menos dar um auxílio no seu sono aí. Que né, dormir faz bem...
        </p>

        <p class="paragraph">
            Agora, se as revelações abaixo não forem suficientes pra ti, pode entrar em contato com a gente usando as
            nossas <span class="link" onclick="typeof toggleMenu == 'function' && toggleMenu()">redes sociais</span> ou
            mandar com muito carinho no nosso email
            <a class="link" href="mailto:contato@podentender.com">contato@podentender.com</a>
            .
        </p>

        <ul>
            <li class="paragraph" style="margin: 5px 0">
                <a href="#o-que-e-podcast" class="link">O que é um podcast?</a>
            </li>
            <li class="paragraph" style="margin: 5px 0">
                <a href="#o-que-e-o-podentender" class="link">O que é o PODEntender?</a>
            </li>
            <li class="paragraph" style="margin: 5px 0">
                <a href="#como-ouvir-o-podcast" class="link">Como ouvir o podcast?</a>
            </li>
            <li class="paragraph" style="margin: 5px 0">
                <a href="#quem-financia-o-podentender" class="link">Quem financia o PODEntender?</a>
            </li>
            <li class="paragraph" style="margin: 5px 0">
                <a href="#como-apoiar-o-podentender" class="link">Como apoiar o PODEntender?</a>
            </li>
        </ul>

        <div class="paragraphs-list" style="margin: 25px 0;">
            <h2 id="o-que-e-podcast" class="heading heading__secondary">O que é um podcast?</h2>

            <p class="paragraph">
                Um podcast é como um programa de rádio, só que é gravado e você escuta na hora que quiser! O público
                deste tipo de conteúdo relata diversos momentos em que costumam consumir podcats: enquanto se deslocam
                para a escola ou trabalho, limpam a casa, praticam atividades físicas, jogam vídeo game ou mesmo naquele
                domingão com o(a) "conje".
            </p>

            <p class="paragraph">
                Seja qual momento lhe encaixar melhor, o podcast acaba sendo um ótimo parceiro de boas risadas.
                Programas como o PODEntender buscam justamente tornar o ouvinte confortável como se estivesse numa
                conversa entre amigos, com toda a pessoalidade possível dentro de nossas limitações!
            </p>
        </div>

        <div class="paragraphs-list" style="margin: 25px 0;">
            <h2 id="o-que-e-o-podentender" class="heading heading__secondary">O que é o PODEntender?</h2>

            <p class="paragraph">
                O PODEntender é uma iniciativa independente de divulgação da ciência Brasileira. Nosso principal
                objetivo é mostrar a todo Brasileiro como funciona o processo de produção científica, e mostrar que a
                ciência não é nenhum bicho de sete cabeças.
            </p>

            <p class="paragraph">
                Você pode saber mais nesta página
                <a href="{{ $page->baseUrl }}/sobre" class="link">sobre o PODEntender</a>
            </p>
        </div>

        <div class="paragraphs-list" style="margin: 25px 0;">
            <h2 id="como-ouvir-o-podcast" class="heading heading__secondary">Como ouvir o podcast?</h2>

            <p class="paragraph">
                Para ouvir ao PODEntender você pode utilizar plataformas como o
                <a href="{{ $page->links['itunes'] }}" target="_blank" class="link">iTunes</a>
                e
                <a href="{{ $page->links['spotify'] }}" target="_blank" class="link">Spotify</a>, usando um agregador de
                podcasts ou mesmo diretamente pelo nosso site sem baixar nenhum programa.
            </p>

            <p class="paragraph">
                Caso você já utilize um agregador de podcasts de sua preferência, basta adicionar o endereço
                <a href="{{ $page->baseUrl }}/feed.xml" class="link">{{ $page->baseUrl }}/feed.xml</a> e ser feliz! Se
                você utiliza android é mais fácil ainda, basta
                <a href="https://www.subscribeonandroid.com/podentender.com/feed.xml" class="link">clicar aqui</a>.
            </p>

            <p class="paragraph">
                Agora, se você não usa e nem quer usar algum programa para escutar, basta visitar no site a página do
                episódio que deseja ouvir e a) apertar o play e ouvir na página mesmo ou b) escolher a opção "Salvar
                como" no link "Baixar" que se encontra logo abaixo do player.
            </p>
        </div>

        <div class="paragraphs-list" style="margin: 25px 0;">
            <h2 id="quem-financia-o-podentender" class="heading heading__secondary">Quem financia o PODEntender?</h2>

            <p class="paragraph">
                Ninguém. Ao menos não financeiramente.
            </p>

            <p class="paragraph">
                O PODEntender é uma iniciativa independente e sem fins lucrativos. O que nos mantém caminhando é
                justamente a nossa missão e o carinho que recebemos de nossos ouvintes todos os dias.
            </p>

            <p class="paragraph">
                Apesar de não possuir fins lucrativos, estamos trabalhando para tornar o conteúdo cada vez mais atrativo
                para que possamos atrair capital suficiente para terceirizar alguns conteúdos e tornar o projeto cada
                vez mais profissional e de qualidade.
            </p>
        </div>

        <div class="paragraphs-list" style="margin: 25px 0;">
            <h2 id="como-apoiar-o-podentender" class="heading heading__secondary">Como apoiar o PODEntender?</h2>

            <p class="paragraph">
                Atualmente o PODEntender não está aberto para captação de recursos, pois ainda se encontra em estudo de
                viabilidade e alinhamento das oportunidades com a nossa missão. Mas nem só de dinheiro vive o podcast!
            </p>

            <p class="paragraph">
                Você pode sempre apoiar o PODEntender compartilhando o nosso conteúdo em redes sociais, seguindo os
                nossos perfis sociais e divulgando os conteúdos que você gosta.
            </p>

            <p class="paragraph">
                Estamos também sempre abertos a sugestões e críticas, que você pode enviar através do e-mail
                <a href="mailto:contato@podentender.com" class="link">contato@podentender.com</a>.
            </p>

            <p class="paragraph">
                E para os desenvolvedores e designers de plantão, os nossos projetos são de código aberto e estão
                disponíveis no nosso <a href="https://github.com/podentender" class="link">Github</a>. Qualquer bug,
                sugestão ou até mesmo melhoria será muito bem recebido lá.
            </p>
        </div>
    </article>


    @include('_partials.layout.sidemenu.sidemenu')
    @include('_partials.layout.footer.footer')

    <link rel="stylesheet" href="{{ $page->getBaseUrl() }}/assets/build/css/main.css">
    <script src="{{ $page->getBaseUrl() }}/assets/build/js/main.js" async></script>
@endsection

<header class="episode__cover">
    <h1 class="heading heading__primary">
        PODEntender #{{ str_pad($page->episode['number'], 3, '0', STR_PAD_LEFT) }} - {{ $page->episode['title'] }}
    </h1>

    <small class="episode__cover__details">
        <time property="na:datePublished" datetime="{{ $page->episode['date'] }}" pubdate="pubdate">
            {{ $page->episode['date'] }}
        </time>
        | em <span class="episode__cover__details--bold">{{ $page->category }}</span>
    </small>

    <img src="{{ $page->episode['cover']['url'] }}" alt="{{ $page->episode['cover']['title'] }}" title="{{ $page->episode['cover']['title'] }}" class="episode__cover__image">
</header>

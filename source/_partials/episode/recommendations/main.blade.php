@if($page->recommended->count() > 0)
<section class="episode__recommended">
    <h1 class="episode__recommended__title">
        Você também pode gostar
    </h1>
    <ul class="episode__recommended__cards">
        @foreach($page->recommended as $recommendation)
            <li>
                <a role="article" href="{{ $recommendation->getUrl() }}" class="episode-card">
                    <img class="episode-card__cover" src="{{ $page->getBaseUrl() . $recommendation->episode['cover']['url'] }}">
                    <h2 class="episode-card__title">
                        PODEntender #{{ $recommendation->episode['number'] }} - {{ $recommendation->episode['title'] }}
                    </h2>
                    <time  class="episode-card__release-date" property="na:datePublished" datetime="2018-10-19" pubdate="pubdate">
                        {{ date('d \d\e F \d\e Y', $recommendation->episode['date']) }}
                    </time>
                    <p class="paragraph">{{ $recommendation->episode['description'] }}</p>
                </a>
            </li>
        @endforeach
    </ul>
</section>
@endif

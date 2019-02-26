<section class="player-card">
    <audio class="player-card__player" controls>
        <source src="{{ $page->episode['blubrry'] }}">
    </audio>

    <p class="player-card__subscribe">
        Podcast:
        <a href="{{ $page->episode['blubrry'] }}" class="link player-card__subscribe-link" target="_blank">
            Reproduzir em uma nova janela
        </a> |
        <a href="{{ $page->episode['blubrry'] }}" class="link player-card__subscribe-link">
            Baixar
        </a>
    </p>
    <p class="player-card__subscribe">
        Assine:
        <a href="{{ $page->feed->androidLink }}" class="link player-card__subscribe-link" title="Subscribe on Android" rel="nofollow">
            Android
        </a> |
        <a href="{{ $page->feed->rss }}" class="link player-card__subscribe-link" title="Assinar via RSS" rel="nofollow">
            RSS
        </a>
    </p>
</section>

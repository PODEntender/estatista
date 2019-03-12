<header class="header_bar">
    <h1 class="header_bar__logo">
        <a href="{{ $page->baseUrl }}">
            <img src="{{ $page->baseUrl . $page->assets->logo }}" alt="PODEntender" />
        </a>
    </h1>
    <section class="header_bar__menu">
        <button class="header_bar__menu__icon" onclick="typeof toggleMenu == 'function' && toggleMenu()">
            <img data-src="{{ $page->baseUrl . $page->assets->icons->menu }}" class="lazy-image" />
        </button>
    </section>
</header>

<noscript>
    <nav class="top-nav">
        <ul class="top-nav__items">
            <li class="top-nav__item">
                <a href="{{ $page->getBaseUrl() }}" class="top-nav__link">
                    Início
                </a>
            </li>
            <li class="top-nav__item">
                <!-- @todo -> add categories page -->
                <a href="#" class="top-nav__link">
                    Episódios
                </a>
            </li>
        </ul>
    </nav>
</noscript>

<nav class="side-menu">
    <div class="side-menu__overlay" onclick="typeof toggleMenu == 'function' && toggleMenu()"></div>
    <button role="button" aria-label="Close Menu" class="side-menu__close-button" onclick="typeof toggleMenu == 'function' && toggleMenu()">
        <img class="lazy-image" data-src="{{ $page->baseUrl }}/assets/images/icons/close.svg" alt="Close Menu" width="16">
    </button>
    <ul>
        @foreach($page->menu->items as $item => $link)
            <li class="side-menu__item">
                <a class="side-menu__item__link" href="{{ $page->baseUrl . $link }}">{{ $item }}</a>
            </li>
        @endforeach
        <li class="side-menu__separator"></li>
        @foreach($page->menu->social as $item => $link)
            <li class="side-menu__item">
                <a class="side-menu__item__link" href="{{ $link }}" target="_blank">{{ $item }}</a>
            </li>
        @endforeach
    </ul>
</nav>

<nav class="side-menu">
    <div class="side-menu__overlay" onclick="typeof toggleMenu == 'function' && toggleMenu()"></div>
    <button role="button" aria-label="Close Menu" class="side-menu__close-button" onclick="typeof toggleMenu == 'function' && toggleMenu()">
        <img class="lazy-image" data-src="{{ $page->baseUrl }}/assets/images/icons/close.svg" alt="Close Menu" width="16">
    </button>
    <ul>
        @foreach($page->menu->items as $key => $group)
            @if ($key > 0)
                <li class="side-menu__separator"></li>
            @endif

            @foreach ($group as $item => $link)
                <li class="side-menu__item">
                    <a class="side-menu__item__link" href="{{ $link }}">{{ $item }}</a>
                </li>
            @endforeach
        @endforeach
    </ul>
</nav>

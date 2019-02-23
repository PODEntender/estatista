<nav class="side-menu">
    <ul>
        @foreach($page->menu->items as $item => $link)
        <li class="side-menu__item">
            <a class="side-menu__item__link" href="{{ $link }}">{{ $item }}</a>
        </li>
        @endforeach
    </ul>
</nav>

<nav>
    <ul>
        @foreach($page->menu->items as $name => $uri)
            <li>
                <a href="{{$page->url($uri)}}">
                    {{$name}}
                </a>
            </li>
        @endforeach
    </ul>
</nav>

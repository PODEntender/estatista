@if($page->recommended->count() > 0)
    <aside>
        <h2>Você também pode gostar</h2>
        <ul>
            @foreach($page->recommended as $recommendation)
                <li>
                    <a href="{{ $recommendation->getUrl() }}">
                        #{{ $recommendation->episode['number'] }} - {{ $recommendation->episode['title'] }}
                    </a>
                    <p>{{ $recommendation->episode['description'] }}</p>
                </li>
            @endforeach
        </ul>
    </aside>
@endif

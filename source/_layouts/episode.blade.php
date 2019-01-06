@extends('_layouts.master')

@section('head')
<title>
    PODEntender #{{ str_pad($page->episode['number'], 3, '0', STR_PAD_LEFT) }} - {{ $page->episode['title'] }}
</title>
@endsection

@section('body')
    <h1>PODEntender #{{ str_pad($page->episode['number'], 3, '0', STR_PAD_LEFT) }} - {{ $page->episode['title'] }}</h1>
    <article>
        @yield('content')
    </article>

    @if($page->recommended->count() > 0)
    <aside>
        <h2>Você também pode gostar</h2>
        <ul>
        @foreach($page->recommended as $recommendation)
            <li>
                <strong>{{ $recommendation->episode['title'] }}</strong>
                <p>{{ $recommendation->episode['description'] }}</p>
            </li>
        @endforeach
        </ul>
    </aside>
    @endif
@endsection

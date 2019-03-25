<h2 class="heading heading__secondary">
    Comentado neste episódio
</h2>

<ul class="episode__commented-list">
    @foreach($page->links as $title => $link)
        <li class="episode__commented-list-item">
            <a rel="nofollow" href="{{ $link }}">{{ $title }}</a>
        </li>
    @endforeach
</ul>

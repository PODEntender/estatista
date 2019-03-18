<ul class="pagination">
    <li class="pagination__item">
        <a class="link {{ $previousPath ? '' : 'link--inactive' }}" href="{{ $previousPath ? $page->baseUrl . $previousPath : '#' }}">
            Anterior
        </a>
    </li>
    @foreach($pages as $number => $path)
        <li class="pagination__item">
            <a class="link {{ $number === $currentPage ? 'link--active' : '' }}" href="{{ $page->baseUrl . $path }}">
                {{ $number }}
            </a>
        </li>
    @endforeach
    <li class="pagination__item">
        <a class="link {{ $nextPath ? '' : 'link--inactive' }}" href="{{ $nextPath ? $page->baseUrl . $nextPath : '#' }}">
            Próximo
        </a>
    </li>
</ul>

<section class="author-card-list">
    <ul class="author-card-list__list">
        @foreach($authors as $author)
            <li class="author-card-list__list-item">
                @include('_partials.authors.author-card', ['author' => $author])
            </li>
        @endforeach
    </ul>
</section>

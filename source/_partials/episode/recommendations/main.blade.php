@if(count($recommendations) > 0)
<section class="recommended-episodes">
    <h1 class="recommended-episodes__title">Para você continuar entendendo</h1>

    @include('_partials.episode.episode-card-list', [
        'episodes' => $recommendations,
        'hidden' => ['description']
    ])
</section>
@endif

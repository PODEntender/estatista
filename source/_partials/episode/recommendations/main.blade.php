@if($recommendations && $recommendations->count() > 0)
<section class="recommended-episodes">
    <h1 class="recommended-episodes__title">
        {{ $title ?? 'Para você continuar entendendo' }}
    </h1>

    @include('_partials.episode.episode-card-list', [
        'title' => '',
        'episodes' => $recommendations->map(function (\PODEntender\Domain\Model\Post\AudioEpisode $episode) {
            return [
                'url' => $episode->url(),
                'image' => $episode->cover(),
                'timestamp' => $episode->createdAt()->getTimestamp(),
                'title' => $episode->title(),
                'description' => substr($episode->description(), 0, 146) . ' ...',
            ];
        })->toArray(),
        'hidden' => ['description'],
        'classes' => $classes ?? [],
    ])
</section>
@endif

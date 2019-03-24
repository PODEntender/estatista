@php
    $json = [
        '@context' => 'http://schema.org',
        '@type' => 'NewsArticle',
        'image' => $images,
        'datePublished' => date('Y-m-d', $datePublished),
        'headline' => substr($headline, 0, 110),
        'author' => [
            '@type' => 'Organization',
            'name' => $author,
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => $publisher,
            'logo' => [
                '@type' => 'ImageObject',
                'url' => $publisherLogo,
            ],
        ],
    ];

    $encodedJson = json_encode($json);
@endphp
<script type='application/ld+json'>{!! $encodedJson !!}</script>

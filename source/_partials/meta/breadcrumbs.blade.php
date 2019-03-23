@php
$json = [
    '@context' => 'http://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
    ],
];

foreach ($items as $pos => $item) {
    $json['itemListElement'][] = [
        '@type' => 'ListItem',
        'position' => $pos + 1,
        'item' => [
            '@id' => $item['id'],
            '@type' => $item['type'] ?? 'WebPage',
            'name' => $item['name'],
            'image' => $item['image'],
        ],
    ];
}

$encodedJson = json_encode($json);
@endphp

<script type='application/ld+json'>{!! $encodedJson !!}</script>

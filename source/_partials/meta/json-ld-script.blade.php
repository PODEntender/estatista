@php
    $encodedJson = json_encode($schema);
@endphp
<script type='application/ld+json'>{!! $encodedJson !!}</script>

@php
$favicon = function (string $size) use ($page): string {
    return $page->getBaseUrl() . '/assets/images/icons/favicon-' . $size . '.png';
};
@endphp

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="theme-color" content="#ff8237">

        <link rel="icon" href="{{ $favicon('32x32') }}" size="32x32">
        <link rel="icon" href="{{ $favicon('192x192') }}" size="192x192">
        <link rel="apple-touch-icon-precomposed" href="{{ $favicon('180x180') }}">
        <meta name="msapplication-TileImage" content="{{ $favicon('270x270') }}" />

        @yield('head')
    </head>
    <body>
        @yield('body')
        @yield('footer')
    </body>
</html>

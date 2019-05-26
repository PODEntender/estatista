@php

$classes = $classes ?? [];
$classes = array_unique($classes);

$blankImage = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAA/8AAAI/CAQAAACLlKHdAAAHaElEQVR42u3VMQEAAAjDMOb/RBmO0MBNIqFP01MAwCuxfwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/ALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwD7FwEA7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BwP4BAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AcD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gHA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8A7N/+AcD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gHA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8A7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BwP4BAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AcD+7R8A7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BwP4BAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AcD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gHA/kUAAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/ALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwCwfwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAPu3fwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/ALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwCwfwCwf/sHAPsHAOwfALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/ALB/AMD+AQD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwD7BwDsHwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwCwfwCwfwDA/gEA+wcA7B8AsH8AwP4BAPsHAOwfALB/AMD+AQD7BwDsHwA4Wal2Igmuf1r3AAAAAElFTkSuQmCC';

@endphp
<noscript>
    <img src="{{ $url }}" alt="{{ $alt }}" title="{{ $title }}" class="{{ implode(' ', $classes) }}">
</noscript>

<img data-src="{{ $url }}" src="{{ $blankImage }}" alt="{{ $alt }}" title="{{ $title }}" class="{{ implode(' ', array_merge($classes, ['lazy-image'])) }}">

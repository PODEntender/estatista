@php
$disqus = $disqus ?? [
    'identifier' => $page->episode['disqus'] ?? $page->episode['number'],
];
@endphp

<aside class="episode__comments">
    <h2 class="episode__comments__title">
        Comentários
    </h2>
    <div id="disqus_thread"></div>
    <script>
      var disqus_config = function () {
        this.page.identifier = '{{ $disqus['identifier'] }}';
      };

      window.initDisqus = (function() {
        var d = document, s = d.createElement('script');
        s.src = 'https://podentender.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);

        window.initDisqus = undefined;
      });
    </script>
    <noscript>
        Por favor habilite o JavaScript nesta página para visualizar
        <a href="https://disqus.com/?ref_noscript">
            os comentários
        </a>.
    </noscript>
</aside>

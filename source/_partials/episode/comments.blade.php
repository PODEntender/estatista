@php
$disqus = $disqus ?? [
    'url' => 'http://gabrielkamimura.github.io/',
    'identifier' => 'Demo'
];
@endphp

<aside class="episode__comments">
    <h1 class="episode__comments__title">
        Comentários
    </h1>
    <div id="disqus_thread"></div>
    <script>
      /**
       *  Here just  to see how it looks like with disqus*/
      var disqus_config = function () {
        this.page.url = '{{ $disqus['url'] }}';
        this.page.identifier = '{{ $disqus['identifier'] }}';
      };

      (function() {
        var d = document, s = d.createElement('script');
        s.src = 'https://test-ttggsvzvin.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
      })();
    </script>
    <noscript>
        Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a>
    </noscript>
</aside>

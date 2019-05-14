[![Build Status](https://travis-ci.org/PODEntender/estatista.svg?branch=master)](https://travis-ci.org/PODEntender/estatista)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/PODEntender/estatista/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/PODEntender/estatista/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/PODEntender/estatista/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Code Coverage](https://scrutinizer-ci.com/g/PODEntender/estatista/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/PODEntender/estatista/?branch=master)

Estatista
---

Pacote para geração do blog estático do site [https://podentender.com](https://podentender.com).

Neste projeto encontram-se os posts do site no formato `.blade.md`. Ao atualizar
qualquer um dos arquivos, o site será gerado novamente através do `Travis CI` e
publicado no branch [gh-pages](https://github.com/PODEntender/estatista/tree/gh-pages). 

### Páginas disponíveis

Para visitar as páginas existentes, recomenda-se (por enquanto) utilizar
o endereço `/sitemap.xml`. Lá estão listadas as páginas públicas do projeto.

No `gh-pages` o endereço é [public_html/sitemap.xml](https://podentender.github.io/estatista/sitemap.xml). 

### Tecnologias

O projeto utiliza o gerador estático de páginas [Jigsaw](https://jigsaw.tighten.co/).

O front-end utiliza-se de `sass` e `BEM` para estilos, e `Vanilla JS` para as interações.

### Rodando o projeto em modo desenvolvimento

Para executar o projeto em sua máquina local primeiro instale as dependências:

```bash
$ composer install
```

O comando acima irá instalar os pacotes PHP e Node necessários.

Em seguida para testar o projeto em modo desenvolvimento:

```bash
$ composer run dev
```

Com o comando acima você será capaz de alterar os arquivos e enxergar as mudanças
imediatamente.

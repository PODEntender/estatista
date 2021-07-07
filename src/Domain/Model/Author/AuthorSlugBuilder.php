<?php

namespace PODEntender\Domain\Model\Author;

use Illuminate\Support\Str;

class AuthorSlugBuilder
{
    const PREFIX = 'autores/';

    public function build(string $authorUid): string
    {
        return self::PREFIX . Str::slug($authorUid, '-');
    }
}

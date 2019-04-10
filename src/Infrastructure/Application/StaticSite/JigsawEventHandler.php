<?php

namespace PODEntender\Infrastructure\Application\StaticSite;

use TightenCo\Jigsaw\Jigsaw;

interface JigsawEventHandler
{
    public function handle(Jigsaw $jigsaw): void;
}

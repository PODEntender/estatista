<?php

namespace PODEntender\EventHandler;

use TightenCo\Jigsaw\Jigsaw;

interface HandlerInterface
{
    public function handle(Jigsaw $jigsaw);
}

<?php

namespace PODEntender\Domain\Model\FileProcessing;

use Illuminate\Support\Collection;

class OutputFileCollection extends Collection
{
    public function fetchByPath(string $path): ?OutputFile
    {
        return $this
            ->filter(function (OutputFile $file) use ($path) {
                return $file->path() === $path;
            })
            ->first();
    }
}

<?php

namespace PODEntender\Domain\Model\FileProcessing;

use ArrayObject;
use InvalidArgumentException;

class OutputFileCollection extends ArrayObject
{
    public function __construct(array $files = []) {
        $nonOutputFileItems = array_filter($files, function ($file) {
            return !$file instanceof OutputFile;
        });

        if (count($nonOutputFileItems) > 0) {
            throw new InvalidArgumentException(
                'OutputFileCollection elements must be instanceof OutputFile.'
            );
        }

        parent::__construct($files);
    }
}

<?php

namespace PODEntender\Domain\Model\FileProcessing;

interface OutputFileRepository
{
    public function all(): OutputFileCollection;
}

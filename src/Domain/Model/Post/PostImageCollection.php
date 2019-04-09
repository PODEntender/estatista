<?php

namespace PODEntender\Domain\Model\Post;

use ArrayObject;
use InvalidArgumentException;

class PostImageCollection extends ArrayObject
{
    public function __construct(array $images = []) {
        $nonPostImageItems = array_filter($images, function ($postImage) {
            return !$postImage instanceof PostImage;
        });

        if (count($nonPostImageItems) > 0) {
            throw new InvalidArgumentException('PostImageCollection elements must be instanceof PostImage.');
        }

        parent::__construct($images);
    }
}

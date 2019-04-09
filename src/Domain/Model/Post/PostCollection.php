<?php

namespace PODEntender\Domain\Model\Post;

use ArrayObject;
use InvalidArgumentException;

class PostCollection extends ArrayObject
{
    public function __construct(array $posts = []) {
        $nonPostItems = array_filter($posts, function ($post) {
            return !$post instanceof Post;
        });

        if (count($nonPostItems) > 0) {
            throw new InvalidArgumentException('PostCollection elements must be instanceof Post.');
        }

        parent::__construct($posts);
    }
}

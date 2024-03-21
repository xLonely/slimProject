<?php

declare(strict_types=1);

namespace App\Domain\Posts;

interface PostsRepository
{
    /**
     * @return Posts[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Posts
     * @throws PostsNotFoundException
     */
    public function findPostsOfId(int $id): Posts;
}

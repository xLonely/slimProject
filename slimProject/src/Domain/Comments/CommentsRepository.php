<?php

declare(strict_types=1);

namespace App\Domain\Comments;

interface CommentsRepository
{
    /**
     * @return Comments[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Comments
     * @throws CommentsNotFoundException
     */
    public function findCommentsOfPostId(int $id): array;
}

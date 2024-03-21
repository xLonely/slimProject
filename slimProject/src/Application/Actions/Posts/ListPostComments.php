<?php

declare(strict_types=1);

namespace App\Application\Actions\Posts;

use Psr\Http\Message\ResponseInterface as Response;

class ListPostComments extends PostComments
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $postId     = (int) $this->resolveArg('post_id');
        $comments   = $this->commentsRepository->findCommentsOfPostId($postId);

        $this->logger->info("Comments list was viewed.");

        return $this->respondWithData($comments);
    }
}

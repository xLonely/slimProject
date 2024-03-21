<?php

declare(strict_types=1);

namespace App\Application\Actions\Comments;

use Psr\Http\Message\ResponseInterface as Response;

class ListCommentsAction extends CommentsAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $comments = $this->commentsRepository->findAll();

        $this->logger->info("Comments list was viewed.");

        return $this->respondWithData($comments);
    }
}

<?php

declare(strict_types=1);

namespace App\Application\Actions\Posts;

use Psr\Http\Message\ResponseInterface as Response;

class ListPostsAction extends PostsAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $posts = $this->postsRepository->findAll();

        $this->logger->info("Posts list was viewed.");

        return $this->respondWithData($posts);
    }
}

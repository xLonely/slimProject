<?php

declare(strict_types=1);

namespace App\Application\Actions\Posts;

use App\Application\Actions\Action;
use App\Domain\Posts\PostsRepository;
use Psr\Log\LoggerInterface;

abstract class PostsAction extends Action
{
    protected PostsRepository $postsRepository;

    public function __construct(LoggerInterface $logger, PostsRepository $postsRepository)
    {
        parent::__construct($logger);
        $this->postsRepository = $postsRepository;
    }

}

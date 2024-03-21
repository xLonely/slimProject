<?php

declare(strict_types=1);

namespace App\Application\Actions\Posts;

use App\Application\Actions\Action;
use App\Domain\Comments\CommentsRepository;
use Psr\Log\LoggerInterface;

abstract class PostComments extends Action
{
    protected CommentsRepository $commentsRepository;

    public function __construct(LoggerInterface $logger, CommentsRepository $commentsRepository)
    {
        parent::__construct($logger);
        $this->commentsRepository = $commentsRepository;
    }

}

<?php

declare(strict_types=1);

namespace App\Application\Actions\Comments;

use App\Application\Actions\Action;
use App\Domain\Comments\CommentsRepository;
use Psr\Log\LoggerInterface;

abstract class CommentsAction extends Action
{
    protected CommentsRepository $commentsRepository;

    public function __construct(LoggerInterface $logger, CommentsRepository $commentsRepository)
    {
        parent::__construct($logger);
        $this->commentsRepository = $commentsRepository;
    }

}

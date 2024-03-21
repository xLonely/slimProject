<?php

declare(strict_types=1);

namespace App\Domain\Comments;

use App\Domain\DomainException\DomainRecordNotFoundException;

class CommentsNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The user you requested does not exist.';
}

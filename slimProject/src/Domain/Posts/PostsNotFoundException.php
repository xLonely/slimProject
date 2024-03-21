<?php

declare(strict_types=1);

namespace App\Domain\Posts;

use App\Domain\DomainException\DomainRecordNotFoundException;

class PostsNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The user you requested does not exist.';
}

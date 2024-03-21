<?php

declare(strict_types=1);

use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\User\InMemoryUserRepository;

use App\Domain\Posts\PostsRepository;
use App\Infrastructure\Persistence\Posts\InMemoryPostsRepository;

use App\Domain\Comments\CommentsRepository;
use App\Infrastructure\Persistence\Comments\InMemoryCommentsRepository;

use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        UserRepository::class => \DI\autowire(InMemoryUserRepository::class),
        PostsRepository::class => \DI\autowire(InMemoryPostsRepository::class),
        CommentsRepository::class => \DI\autowire(InMemoryCommentsRepository::class),
    ]);
};

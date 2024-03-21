<?php

declare(strict_types=1);

namespace App\Domain\Posts;

use JsonSerializable;

class Posts implements JsonSerializable
{
    private ?int $id;
    private ?int $userId;

    private string $title;

    private string $body;


    public function __construct(?int $id, ?int $userId, string $title, string $body)
    {
        $this->id       = $id;
        $this->userId   = $userId;
        $this->title    = $title;
        $this->body     = $body;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getPostTitle(): string
    {
        return $this->title;
    }

    public function getPostBody(): string
    {
        return $this->body;
    }


    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'id'        => $this->id,
            'userId'    => $this->userId,
            'title'     => $this->title,
            'body'      => $this->body,
        ];
    }
}

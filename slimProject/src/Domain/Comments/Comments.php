<?php

declare(strict_types=1);

namespace App\Domain\Comments;

use JsonSerializable;

class Comments implements JsonSerializable
{
    private ?int $id;
    private ?int $postId;

    private string $name;
    private string $email;

    private string $body;


    public function __construct(?int $id, ?int $postId, string $name, string $email, string $body)
    {
        $this->id       = $id;
        $this->postId   = $postId;
        $this->name     = $name;
        $this->email    = $email;
        $this->body     = $body;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostId(): ?int
    {
        return $this->postId;
    }

    public function getPostName(): string
    {
        return $this->name;
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
            'postId'    => $this->postId,
            'name'      => $this->name,
            'email'     => $this->email,
            'body'      => $this->body,
        ];
    }
}

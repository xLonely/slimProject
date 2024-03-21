<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Comments;

use PDO;
use App\Models\DB;
use App\Domain\Comments\Comments;
use App\Domain\Comments\CommentsNotFoundException;
use App\Domain\Comments\CommentsRepository;

class InMemoryCommentsRepository implements CommentsRepository
{
    /**
     * @var Comments[]
     */
    private array $comments;

    /**
     * @param Comments[]|null $comments
     */
    public function __construct(array $comments = null)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $sql = "SELECT * FROM comments";

        try {
            $db = new Db();
            $conn = $db->connect();
            $stmt = $conn->query($sql);
            $comments = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            return $comments;
        } catch (PDOException $e) {
            $error = array(
                "message" => $e->getMessage()
            );

            return $error;
        }

    }


    public function findCommentsOfPostId(int $id): array
    {
        $sql = "SELECT * FROM comments WHERE postId = ".$id;

        try {
            $db = new Db();
            $conn = $db->connect();
            $stmt = $conn->query($sql);
            $comments = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            return $comments;
        } catch (PDOException $e) {
            $error = array(
                "message" => $e->getMessage()
            );

            return $error;
        }

    }

    /**
     * {@inheritdoc}
     */
}

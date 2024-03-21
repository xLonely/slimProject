<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Posts;

use PDO;
use App\Models\DB;
use App\Domain\Posts\Posts;
use App\Domain\Posts\PostsNotFoundException;
use App\Domain\Posts\PostsRepository;

class InMemoryPostsRepository implements PostsRepository
{
    /**
     * @var Posts[]
     */
    private array $posts;

    /**
     * @param Posts[]|null $posts
     */
    public function __construct(array $posts = null)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $sql = "SELECT * FROM posts";

        try {
            $db = new Db();
            $conn = $db->connect();
            $stmt = $conn->query($sql);
            $posts = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            return $posts;
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
    public function findPostsOfId(int $id): Posts
    {
        if (!isset($this->posts[$id])) {
            throw new PostsNotFoundException();
        }

        return $this->posts[$id];
    }
}

<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;

$postsUrl = 'https://jsonplaceholder.typicode.com/posts';
$commentsUrl = 'https://jsonplaceholder.typicode.com/comments';

$dbHost = 'localhost';
$dbName = 'enf_db';
$dbUser = 'root';
$dbPass = '';

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Veritabanı başarılı!\n";
} catch (PDOException $e) {
    echo "Veritabanı başarısız: " . $e->getMessage() . "\n";
    exit(1);
}

// HTTP istemcisini oluştur
$client = new Client();

try {
    // POSTS verilerini al
    $postsResponse = $client->get($postsUrl);
    $posts = json_decode($postsResponse->getBody()->getContents(), true);

    // POSTS tablosuna verileri ekle
    $pdo->beginTransaction();
    $pdo->query("DELETE FROM posts");
    $stmt = $pdo->prepare("INSERT INTO posts (userId, id, title, body) VALUES (:userId, :id, :title, :body)");
    foreach ($posts as $post) {
        $stmt->execute($post);
    }
    $pdo->commit();
    echo "POSTS eklendi!\n";

    // COMMENTS verilerini al
    $commentsResponse = $client->get($commentsUrl);
    $comments = json_decode($commentsResponse->getBody()->getContents(), true);

    // COMMENTS tablosuna verileri ekle
    $pdo->beginTransaction();
    $pdo->query("DELETE FROM comments");
    $stmt = $pdo->prepare("INSERT INTO comments (postId, id, name, email, body) VALUES (:postId, :id, :name, :email, :body)");
    foreach ($comments as $comment) {
        $stmt->execute($comment);
    }
    $pdo->commit();
    echo "COMMENTS eklendi!\n";

} catch (Exception $e) {
    echo "Hata: " . $e->getMessage() . "\n";
    exit(1);
}

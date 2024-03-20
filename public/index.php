<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();


$db = "mysql:host=127.0.0.1;dbname=enf_db;charset=utf8";
$pdo = new PDO($db, 'root', '',[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);


$app->get('/api/posts', function (Request $request, Response $response, $args) use ($pdo) {

    $posts      = $pdo->query('SELECT * from posts');
    $postsData  = $posts->fetchAll(PDO::FETCH_ASSOC);
    $body       = json_encode($postsData);

    $response->getBody()->write($body);

    return $response;
});

$app->get('/api/comments', function (Request $request, Response $response, $args) use ($pdo) {

    $posts      = $pdo->query('SELECT * from comments');
    $postsData  = $posts->fetchAll(PDO::FETCH_ASSOC);
    $body       = json_encode($postsData);

    $response->getBody()->write($body);

    return $response;
});

$app->get('/api/posts/{post_id}/comments', function (Request $request, Response $response, $args) use ($pdo) {



    if(count($args) == 0 || empty($args['post_id'])) {
        $response->getBody()->write(json_encode(array("status" => true, "message" => "id parameter must be integer")));
        return $response;
    }

    $query = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
    $query->execute(
        array(
            $args["post_id"]
        )
    );

    if($query->rowCount() == 0) {
        $response->getBody()->write(json_encode(array("status" => true, "message" => "post with id: ".$args["post_id"]." is not found")));
        return $response;
    }

    $query      = $pdo->prepare('SELECT * from comments WHERE postId = ?');
    $query->execute(
        array(
            $args['post_id']
        )
    );
    $comments  = $query->fetchAll(2);

    $response->getBody()->write(json_encode(array("status" => true, "items" => $comments)));

    return $response;
});


$app->get('/import/comments', function (Request $request, Response $response, $args) use ($pdo) {

    $data = file_get_contents("https://jsonplaceholder.typicode.com/comments");
    $data = json_decode($data, true);

    $inserts = array();

    foreach ($data as $item) {

        $inserts[] = "(".$item["id"].",".$item["postId"].", '".$item["name"]."', '".$item["email"]."', '".$item["body"]."')";

    }

    $pdo->query("DELETE FROM comments");

    try {
        $pdo->query("INSERT INTO comments(id, postId, name, email, body) VALUES ".implode(",", $inserts));
        $response->getBody()->write(json_encode(array("status" => true, "message" => "comments added successfuly")));
    }
    catch (PDOException $e) {
        $response->getBody()->write(json_encode(array("status" => false, "message" => $e->getMessage())));
    }

    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/import/posts', function (Request $request, Response $response, $args) use ($pdo) {

    $data = file_get_contents("https://jsonplaceholder.typicode.com/posts");
    $data = json_decode($data, true);

    $inserts = array();

    foreach ($data as $item) {

        $inserts[] = "(".$item["id"].",".$item["userId"].", '".$item["title"]."', '".$item["body"]."')";

    }

    $pdo->query("DELETE FROM posts");

    try {
        $pdo->query("INSERT INTO posts(id, userId, title, body) VALUES ".implode(",", $inserts));
        $response->getBody()->write(json_encode(array("status" => true, "message" => "posts added successfuly")));
    }
    catch (PDOException $e) {
        $response->getBody()->write(json_encode(array("status" => false, "message" => $e->getMessage())));
    }

    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
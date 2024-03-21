<?php

declare(strict_types=1);

use App\Application\Actions\Comments\ListCommentsAction;
use App\Application\Actions\Posts\ListPostsAction;
use App\Application\Actions\Posts\ListPostComments;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/posts', function (Group $group) {
        $group->get('', ListPostsAction::class);
    });

    $app->group('/comments', function (Group $group) {
        $group->get('', ListCommentsAction::class);
    });

    $app->group('/posts/{post_id}/comments', function (Group $group) {
        $group->get('', ListPostComments::class);
    });

};

<?php
declare(strict_types=1);

use App\Application\Actions\Album\ListAlbumsAction;
use App\Application\Actions\Album\ViewAlbumAction;
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
        $response->getBody()->write('Spotify band discography endpoint');
        return $response;
    });

    $app->group('/api/v1/albums', function (Group $group) {
        $group->get('', ListAlbumsAction::class);
    });
};

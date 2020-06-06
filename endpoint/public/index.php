<?php
declare(strict_types=1);

use App\Application\Handlers\HttpErrorHandler;
use App\Application\Handlers\ShutdownHandler;
use App\Application\ResponseEmitter\ResponseEmitter;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Factory\ServerRequestCreatorFactory;

require __DIR__ . '/../vendor/autoload.php';

// Instantiate PHP-DI ContainerBuilder
$containerBuilder = new ContainerBuilder();

if (false) { // Should be set to true in production
	$containerBuilder->enableCompilation(__DIR__ . '/../var/cache');
}

// Set up settings
$settings = require __DIR__ . '/../app/settings.php';
$settings($containerBuilder);

// Set up dependencies
$dependencies = require __DIR__ . '/../app/dependencies.php';
$dependencies($containerBuilder);

// Set up repositories
$repositories = require __DIR__ . '/../app/repositories.php';
$repositories($containerBuilder);

// Build PHP-DI Container instance
$container = $containerBuilder->build();

// Instantiate the app
AppFactory::setContainer($container);
$app = AppFactory::create();
$callableResolver = $app->getCallableResolver();

// Register middleware
$middleware = require __DIR__ . '/../app/middleware.php';
$middleware($app);

// Register routes
$routes = require __DIR__ . '/../app/routes.php';
$routes($app);

/** @var bool $displayErrorDetails */
$displayErrorDetails = $container->get('settings')['displayErrorDetails'];

// Create Request object from globals
$serverRequestCreator = ServerRequestCreatorFactory::create();
$request = $serverRequestCreator->createServerRequestFromGlobals();

// Create Error Handler
$responseFactory = $app->getResponseFactory();
$errorHandler = new HttpErrorHandler($callableResolver, $responseFactory);

// Create Shutdown Handler
$shutdownHandler = new ShutdownHandler($request, $errorHandler, $displayErrorDetails);
register_shutdown_function($shutdownHandler);

// Add Routing Middleware
$app->addRoutingMiddleware();

// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware($displayErrorDetails, false, false);
$errorMiddleware->setDefaultErrorHandler($errorHandler);

// Run App & Emit Response
$response = $app->handle($request);
$responseEmitter = new ResponseEmitter();
$responseEmitter->emit($response);

/* Spotify configuration variables
** https://developer.spotify.com/dashboard/applications/a268e150dca64df8bfbc478377a023e3
*/
$clientId = 'a268e150dca64df8bfbc478377a023e3';
$clientSecret = '3d21fec0a1d64b14a1cb00d2c2ad41cd';
$accessToken = 'YTI2OGUxNTBkY2E2NGRmOGJmYmM0NzgzNzdhMDIzZTM6M2QyMWZlYzBhMWQ2NGIxNGExY2IwMGQyYzJhZDQxY2Q=';

/* Spotify API Postman test endpoints
- Get token
  curl -X POST \
  https://accounts.spotify.com/api/token \
  -H 'authorization: Basic YTI2OGUxNTBkY2E2NGRmOGJmYmM0NzgzNzdhMDIzZTM6M2QyMWZlYzBhMWQ2NGIxNGExY2IwMGQyYzJhZDQxY2Q=' \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/x-www-form-urlencoded' \
  -H 'postman-token: b43ab470-c889-4b87-6d78-e7ea21abee00' \
  -d grant_type=client_credentials

  - Search artist by name
  curl -X GET \
  'https://api.spotify.com/v1/search?q=Yngwie%20Malmsteen&type=artist&offset=0' \
  -H 'accept: application/json' \
  -H 'authorization: Bearer BQBz6RMyMqG64extMmVlQu0zUuRKIFb0rnaz6XKe_5Ay_Z9lUe4G3Ru7cnluiynd9db8cnEKRI2HK8pt4iw' \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/json' \
  -H 'postman-token: a72fe587-ced0-cbc6-4b6f-973257bb5235'
  
  - Get artist album's by id
  curl -X GET \
  'https://api.spotify.com/v1/artists/5DpSoH5zCXNRqYai7pmcGG/albums?market=ES' \
  -H 'accept: application/json' \
  -H 'authorization: Bearer BQBz6RMyMqG64extMmVlQu0zUuRKIFb0rnaz6XKe_5Ay_Z9lUe4G3Ru7cnluiynd9db8cnEKRI2HK8pt4iw' \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/json' \
  -H 'postman-token: cb22ebf6-57ec-7f33-33bf-64995dc2e9fd'
*/
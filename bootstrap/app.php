<?php

use App\Http\Middleware\LogRoute;
use App\Http\Middleware\Log;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

require_once __DIR__.'/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

$app->withFacades();

$app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/


$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Config Files
|--------------------------------------------------------------------------
|
| Now we will register the "app" configuration file. If the file exists in
| your configuration directory it will be loaded; otherwise, we'll load
| the default version. You may register other files below as needed.
|
*/

$app->configure('app');

$app->configure('mail');
// $app->configureMonologUsing(function ($logger) {
   
//     $handlers = [];
//     $handlers[] = (new RotatingFileHandler(storage_path("logs/media_critical.log"), 0, Logger::CRITICAL, false))->setFormatter(new LineFormatter(null, null, true, true));

//     $handlers[] = (new RotatingFileHandler(storage_path("logs/media_error.log"), 0, Logger::ERROR, false))->setFormatter(new LineFormatter(null, null, true, true));

//     $handlers[] = (new RotatingFileHandler(storage_path("logs/media_warning.log"), 0, Logger::WARNING, false))->setFormatter(new LineFormatter(null, null, true, true));

//     $handlers[] = (new RotatingFileHandler(storage_path("logs/media_info.log"), 0, Logger::INFO, false))->setFormatter(new LineFormatter(null, null, true, true));

//     $monolog->pushHandler($monolog);

//     return $monolog;
//     // $logger->setHandlers($handlers);
// });
$app->alias('mail.manager', Illuminate\Mail\MailManager::class);
$app->alias('mail.manager', Illuminate\Contracts\Mail\Factory::class);

$app->alias('mailer', Illuminate\Mail\Mailer::class);
$app->alias('mailer', Illuminate\Contracts\Mail\Mailer::class);
$app->alias('mailer', Illuminate\Contracts\Mail\MailQueue::class);
/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

// $app->middleware([
//     App\Http\Middleware\ExampleMiddleware::class
// ]);

$app->routeMiddleware([
    // 'auth' => App\Http\Middleware\Authenticate::class,
    'jwt.auth' => App\Http\Middleware\JwtMiddleware::class,
    'log.route'=> App\Http\Middleware\LogRoute::class,
    'loggi'=> App\Http\Middleware\Loggi::class

]);
$app->middleware([
    App\Http\Middleware\CorsMiddleware::class
 ]);
/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
$app->register(App\Providers\EventServiceProvider::class);
$app->register(\Illuminate\Mail\MailServiceProvider::class);
$app->register(\Barryvdh\DomPDF\ServiceProvider::class);
// $app->register(Flipbox\LumenGenerator\LumenGeneratorServiceProvider::class);

$app->configure('dompdf');

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/web.php';
});


// $app->configureMonologUsing(function ($monolog) use ($app) {
//     $bubble = false;

//     foreach ($monolog->getLevels() as $name => $level) {
//         $name = strtolower($name);
//         $monolog->pushHandler(new \Monolog\Handler\StreamHandler($app->storagePath() . "/logs/{$name}.log", $level,
//             $bubble));
//     }
// }); 

// $app->configureMonologUsing(function($monolog) {
//     $handler = new StreamHandler(storage_path('logs/lumen.log'), Logger::ERROR);
//     $handler->setFormatter(new LineFormatter(null, null, true, true));
//     $monolog->pushHandler($handler);

//     return $monolog;
// });

// $app->configureMonologUsing(function($monolog) {
//     $handler = new StreamHandler(storage_path('logs/lumen.log'), Logger::ERROR);
//     $monolog->pushHandler($handler);

//     return $monolog;
// });

// $app->configureMonologUsing(function(Monolog\Logger $monolog) {

//     $handler = (new \Monolog\Handler\StreamHandler(storage_path('/logs/xyz.log')))
//         ->setFormatter(new \Monolog\Formatter\LineFormatter(null, null, true, true));

//     return $monolog->pushHandler($handler);
// });

// $app->configureMonologUsing(function($monolog) {
//     $monolog->pushHandler(new \Monolog\Handler\StreamHandler(storage_path('/logs/xyz.log')));

//     return $monolog;
// });

return $app;

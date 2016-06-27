<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/../')
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

// mono log
$app->configureMonologUsing(function($monolog) {

    // add file handler
    $fileHandler = new Monolog\Handler\RotatingFileHandler(storage_path() . '/logs/laravel.log');
    $monolog->pushHandler($fileHandler);

    // add redis handler
//    $redisHandler = new Monolog\Handler\RedisHandler(new Predis\Client("tcp://localhost:6379"), 'error_logs', \Monolog\Logger::ERROR);
//    $monolog->pushHandler($redisHandler);

    // add BearyChat handler
    $monolog->pushHandler(new App\Services\BearyChat\BearyChatHandler());
});

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;

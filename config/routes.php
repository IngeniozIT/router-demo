<?php

declare(strict_types=1);

use App\AwesomeFeatureController;
use App\AwesomeFeatureIsEnabled;
use App\NotFoundController;
use App\PublicFileController;
use App\ReverseOutputMiddleware;
use IngeniozIT\Router\Route;
use IngeniozIT\Router\RouteGroup;

return new RouteGroup(
    routes: [
        // A simple route to know that the server works
        Route::get('/', fn() => response('<h1>It works !</h1>')),

        // A route that says hello
        Route::get('/hello', fn() => response('Hello, World!')),
        // A route that says hello to someone
        Route::get('/hello/{name}', fn($request) => response('Hello, ' . $request->getAttribute('name') . '!')),

        // Every route inside this group will have its response content reversed by the middleware
        new RouteGroup(
            name: 'reverse',
            middlewares: [ReverseOutputMiddleware::class],
            routes: [
                Route::get(path: '/invert', callback: fn() => response('Hello, World!')),
                Route::get(path: '/invert/{name}', callback: fn($request) => response('Hello, ' . $request->getAttribute('name') . '!')),
            ],
        ),

        // The "awesome feature" is only available if the feature flag is enabled
        new RouteGroup(
            name: 'awesome_feature',
            conditions: [AwesomeFeatureIsEnabled::class],
            routes: [
                Route::get('/awesome', AwesomeFeatureController::class),
            ],
        ),

        // Handles anything you put into the /public folder (try it, browse to '/img.png')
        Route::get('{file}', PublicFileController::class, where: ['file' => '.*']),

        // When a request didn't match any route, this route will be called
        Route::get('{path}', NotFoundController::class, where: ['path' => '.*']),
    ],
);
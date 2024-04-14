<?php

declare(strict_types=1);

use IngeniozIT\Clock\SystemClock;
use IngeniozIT\Edict\Container;
use IngeniozIT\Http\Message\RequestFactory;
use IngeniozIT\Http\Message\ResponseFactory;
use IngeniozIT\Http\Message\ServerRequestFactory;
use IngeniozIT\Http\Message\StreamFactory;
use IngeniozIT\Http\Message\UploadedFileFactory;
use IngeniozIT\Http\Message\UriFactory;
use Psr\Clock\ClockInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;

use function IngeniozIT\Edict\alias;
use function IngeniozIT\Edict\lazyload;

// Register PSR components

/** @var Container $container */
$container->setMany([
    RequestFactoryInterface::class => alias(RequestFactory::class),
    ResponseFactoryInterface::class => alias(ResponseFactory::class),
    ServerRequestFactoryInterface::class => alias(ServerRequestFactory::class),
    StreamFactoryInterface::class => alias(StreamFactory::class),
    UploadedFileFactoryInterface::class => alias(UploadedFileFactory::class),
    UriFactoryInterface::class => alias(UriFactory::class),
    ClockInterface::class => lazyload(static fn(): ClockInterface => new SystemClock(null)),
]);


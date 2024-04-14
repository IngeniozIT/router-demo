<?php

use IngeniozIT\Edict\Container;
use IngeniozIT\Http\Message\ServerRequestFactory;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/** @var Container $container */

response('', $container);

function getRequest(Container $container): ServerRequestInterface
{
    $serverRequestFactory = $container->get(ServerRequestFactory::class);
    $request = $serverRequestFactory->createServerRequestFromGlobals($GLOBALS);
    return $request;
}

function response(string $content = '', ?ContainerInterface $container = null): ResponseInterface
{
    static $staticContainer = null;

    if ($container !== null) {
        $staticContainer = $container;
    }

    $responseFactory = $staticContainer->get(ResponseFactoryInterface::class);
    $response = $responseFactory->createResponse();
    $response->getBody()->write($content);
    $response->getBody()->rewind();
    return $response;
}

function sendResponse(ResponseInterface $response): void
{
    http_response_code($response->getStatusCode());

    foreach (array_keys($response->getHeaders()) as $header) {
        header($header . ': ' . $response->getHeaderLine($header));
    }

    echo $response->getBody();
}
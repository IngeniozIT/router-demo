<?php

declare(strict_types=1);

namespace App;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PublicFileController implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $filePath = 'public' . $request->getAttribute('file');

        // If the file does not exist, exit this controller and continue parsing the next routes
        if (!is_file($filePath)) {
            return $handler->handle($request);
        }

        $mimeType = mime_content_type($filePath);

        return response(file_get_contents($filePath))
            ->withHeader('Content-Type', $mimeType);
    }
}
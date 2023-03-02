<?php

declare(strict_types=1);

namespace Azure\Client\RequestBuilder;

use Psr\Http\Message\RequestInterface;

class JsonContentTypePlugin implements RequestPluginInterface
{
    public function apply(RequestInterface $request): RequestInterface
    {
        return $request->withHeader('Content-Type', 'application/json');
    }
}
<?php

declare(strict_types=1);

namespace Azure\Client\RequestBuilder;

use Psr\Http\Message\RequestInterface;

class BaseUrlPlugin implements RequestPluginInterface
{
    protected string $baseUrl;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function apply(RequestInterface $request): RequestInterface
    {
        $urlEntities = parse_url($this->baseUrl);

        if (!isset($urlEntities['scheme'], $urlEntities['host'])) {
            throw new \InvalidArgumentException('Provide base utl with scheme and host');
        }

        $uri = $request->getUri()->withScheme($urlEntities['scheme'])->withHost($urlEntities['host']);

        return $request->withUri($uri);
    }
}
<?php

declare(strict_types=1);

namespace Azure\Client\RequestBuilder;

use Psr\Http\Message\RequestInterface;

class ApiVersionPlugin implements RequestPluginInterface
{
    /**
     * @var string
     */
    protected const DEFAULT_API_VERSION = '7.0';

    /**
     * @var string
     */
    protected string $apiVersion;

    /**
     * @param string $apiVersion
     */
    public function __construct(string $apiVersion = self::DEFAULT_API_VERSION)
    {
        $this->apiVersion = $apiVersion;
    }

    public function apply(RequestInterface $request): RequestInterface
    {
        $uri = $request->getUri()->withQuery(sprintf('api-version=%s', $this->apiVersion));

        return $request->withUri($uri);
    }
}
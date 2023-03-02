<?php

namespace Azure\Client\RequestBuilder;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

interface RequestBuilderInterface
{
    /**
     * @param \Azure\Client\RequestBuilder\RequestPluginInterface $requestPlugin
     *
     * @return void
     */
    public function addRequestPlugin(RequestPluginInterface $requestPlugin): void;

    /**
     * @param string $method
     * @param \Psr\Http\Message\UriInterface $uri
     * @param array<string, string|array<string>> $headers
     * @param string|null $body
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getRequest(string $method, UriInterface $uri, array $headers = [], ?string $body = null): RequestInterface;
}
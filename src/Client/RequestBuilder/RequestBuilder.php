<?php

declare(strict_types=1);

namespace Azure\Client\RequestBuilder;

use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class RequestBuilder implements RequestBuilderInterface
{
    public const DEFAULT_AZURE_GIT_URL = 'https://dev.azure.com';

    /**
     * @var array<RequestPluginInterface>
     */
    protected array $requestPlugins = [];

    public function addRequestPlugin(RequestPluginInterface $requestPlugin): void
    {
        $this->requestPlugins[] = $requestPlugin;
    }

    public function getRequest(string $method, UriInterface $uri, array $headers = [], ?string $body = null): RequestInterface
    {
        $request = new ServerRequest($method, $uri, $headers, $body);

        $this->addRequestPlugin(new BaseUrlPlugin(static::DEFAULT_AZURE_GIT_URL));
        $this->addRequestPlugin(new JsonContentTypePlugin());
        $this->addRequestPlugin(new ApiVersionPlugin());

        foreach ($this->requestPlugins as $plugin) {
            $request = $plugin->apply($request);
        }

        return $request;
    }
}
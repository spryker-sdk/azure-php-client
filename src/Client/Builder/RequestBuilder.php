<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzure\Client\Builder;

use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;
use SprykerAzure\Client\Builder\Plugin\RequestPluginInterface;

class RequestBuilder implements RequestBuilderInterface
{
    /**
     * @var array<\SprykerAzure\Client\Builder\Plugin\RequestPluginInterface>
     */
    protected array $requestPlugins = [];

    /**
     * @param array<\SprykerAzure\Client\Builder\Plugin\RequestPluginInterface> $requestPlugins
     */
    public function __construct(array $requestPlugins = [])
    {
        $this->requestPlugins = $requestPlugins;
    }

    /**
     * @param \SprykerAzure\Client\Builder\Plugin\RequestPluginInterface $requestPlugin
     *
     * @return void
     */
    public function addRequestPlugin(RequestPluginInterface $requestPlugin): void
    {
        $this->requestPlugins[] = $requestPlugin;
    }

    /**
     * @param string $method
     * @param \Psr\Http\Message\UriInterface $uri
     * @param array<string, string|array<string>> $headers
     * @param string|null $body
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getRequest(string $method, UriInterface $uri, array $headers = [], ?string $body = null): RequestInterface
    {
        $request = new ServerRequest($method, $uri, $headers, $body);

        foreach ($this->requestPlugins as $plugin) {
            $request = $plugin->apply($request);
        }

        return $request;
    }
}

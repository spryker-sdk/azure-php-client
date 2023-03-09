<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzure\Client;

use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Client\ClientInterface as HttpClientInterface;
use SprykerAzure\Api\PullRequestApi\PullRequestApi;
use SprykerAzure\Api\RepositoryApi\RepositoryApi;
use SprykerAzure\Client\Builder\RequestBuilder;
use SprykerAzure\Client\Builder\ResponseDataBuilder;
use SprykerAzure\Client\Plugin\Request\ApiVersionPlugin;
use SprykerAzure\Client\Plugin\Request\BaseUrlPlugin;
use SprykerAzure\Client\Plugin\Request\JsonContentTypePlugin;
use SprykerAzure\Client\Plugin\Request\RequestPluginInterface;
use SprykerAzure\Client\Plugin\Response\ResponseBodyJsonDeserializerPlugin;
use SprykerAzure\Client\Plugin\Response\ResponsePluginInterface;
use SprykerAzure\Client\Plugin\Response\ResponseStatusCheckPlugin;

class ClientBuilder
{
    /**
     * @var array<\SprykerAzure\Client\Plugin\Request\RequestPluginInterface>
     */
    protected array $requestPlugins;

    /**
     * @var array<\SprykerAzure\Client\Plugin\Response\ResponsePluginInterface>
     */
    protected array $responsePlugins;

    /**
     * @var \Psr\Http\Client\ClientInterface|null
     */
    protected ?HttpClientInterface $httpClient;

    /**
     * @param array<\SprykerAzure\Client\Plugin\Request\RequestPluginInterface> $requestPlugins
     * @param array<\SprykerAzure\Client\Plugin\Response\ResponsePluginInterface> $responsePlugins
     * @param \Psr\Http\Client\ClientInterface|null $httpClient
     */
    public function __construct(
        array $requestPlugins = [],
        array $responsePlugins = [],
        ?HttpClientInterface $httpClient = null
    ) {
        $this->requestPlugins = $requestPlugins;
        $this->responsePlugins = $responsePlugins;
        $this->httpClient = $httpClient;
    }

    /**
     * @param \SprykerAzure\Client\Plugin\Request\RequestPluginInterface $requestPlugin
     *
     * @return void
     */
    public function addRequestPlugin(RequestPluginInterface $requestPlugin): void
    {
        $this->requestPlugins[] = $requestPlugin;
    }

    /**
     * @param \SprykerAzure\Client\Plugin\Response\ResponsePluginInterface $responsePlugin
     *
     * @return void
     */
    public function addResponsePlugin(ResponsePluginInterface $responsePlugin): void
    {
        $this->responsePlugins[] = $responsePlugin;
    }

    /**
     * @param \Psr\Http\Client\ClientInterface $httpClient
     *
     * @return void
     */
    public function setHttpClient(HttpClientInterface $httpClient): void
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return \SprykerAzure\Client\ClientInterface
     */
    public function getClient(): ClientInterface
    {
        $requestBuilder = new RequestBuilder(
            array_merge($this->getDefaultRequestPlugins(), $this->requestPlugins),
        );

        $responseDataBuilder = new ResponseDataBuilder(
            array_merge($this->getDefaultResponsePlugins(), $this->responsePlugins),
        );

        $httpClient = $this->httpClient ?? new GuzzleClient();

        return new Client(
            new PullRequestApi($httpClient, $requestBuilder, $responseDataBuilder),
            new RepositoryApi($httpClient, $requestBuilder, $responseDataBuilder),
        );
    }

    /**
     * @return array<\SprykerAzure\Client\Plugin\Request\RequestPluginInterface>
     */
    protected function getDefaultRequestPlugins(): array
    {
        return [
            new BaseUrlPlugin(),
            new JsonContentTypePlugin(),
            new ApiVersionPlugin(),
        ];
    }

    /**
     * @return array<\SprykerAzure\Client\Plugin\Response\ResponsePluginInterface>
     */
    protected function getDefaultResponsePlugins(): array
    {
        return [
            new ResponseStatusCheckPlugin(),
            new ResponseBodyJsonDeserializerPlugin(),
        ];
    }
}

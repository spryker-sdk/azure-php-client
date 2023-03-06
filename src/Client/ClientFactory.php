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
use SprykerAzure\Client\Builder\Plugin\ApiVersionPlugin;
use SprykerAzure\Client\Builder\Plugin\BaseUrlPlugin;
use SprykerAzure\Client\Builder\Plugin\JsonContentTypePlugin;
use SprykerAzure\Client\Builder\Plugin\ResponseBodyJsonDeserializerPlugin;
use SprykerAzure\Client\Builder\Plugin\ResponseThrowablePlugin;
use SprykerAzure\Client\Builder\RequestBuilder;
use SprykerAzure\Client\Builder\RequestBuilderInterface;
use SprykerAzure\Client\Builder\ResponseDataBuilder;
use SprykerAzure\Client\Builder\ResponseDataBuilderInterface;

class ClientFactory
{
    /**
     * @param \SprykerAzure\Client\Builder\RequestBuilderInterface|null $requestBuilder
     * @param \SprykerAzure\Client\Builder\ResponseDataBuilderInterface|null $responseDataBuilder
     * @param \Psr\Http\Client\ClientInterface|null $httpClient
     *
     * @return \SprykerAzure\Client\ClientInterface
     */
    public function createClient(
        ?RequestBuilderInterface $requestBuilder = null,
        ?ResponseDataBuilderInterface $responseDataBuilder = null,
        ?HttpClientInterface $httpClient = null
    ): ClientInterface {
        if ($requestBuilder === null) {
            $requestBuilder = $this->getDefaultRequestBuilder();
        }

        if ($responseDataBuilder === null) {
            $responseDataBuilder = $this->getDefaultResponseDataBuilder();
        }

        if ($httpClient === null) {
            $httpClient = new GuzzleClient();
        }

        return new Client(
            new PullRequestApi($httpClient, $requestBuilder, $responseDataBuilder),
            new RepositoryApi($httpClient, $requestBuilder, $responseDataBuilder),
        );
    }

    /**
     * @return \Psr\Http\Client\ClientInterface
     */
    public function getDefaultHttpClient(): HttpClientInterface
    {
        return new GuzzleClient();
    }

    /**
     * @return \SprykerAzure\Client\Builder\RequestBuilderInterface
     */
    public function getDefaultRequestBuilder(): RequestBuilderInterface
    {
        return new RequestBuilder([
                new BaseUrlPlugin(),
                new JsonContentTypePlugin(),
                new ApiVersionPlugin(),
            ]);
    }

    /**
     * @return \SprykerAzure\Client\Builder\ResponseDataBuilderInterface
     */
    public function getDefaultResponseDataBuilder(): ResponseDataBuilderInterface
    {
        return new ResponseDataBuilder([
            new ResponseThrowablePlugin(),
            new ResponseBodyJsonDeserializerPlugin(),
        ]);
    }
}

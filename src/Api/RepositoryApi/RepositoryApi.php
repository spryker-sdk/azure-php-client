<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzure\Api\RepositoryApi;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\UriInterface;
use SprykerAzure\Api\RepositoryPath;
use SprykerAzure\Client\Builder\RequestBuilderInterface;
use SprykerAzure\Client\Builder\ResponseDataBuilderInterface;

class RepositoryApi implements RepositoryApiInterface
{
    /**
     * @var string
     */
    protected const API_ENDPOINT_URL = '/%s/%s/_apis/git/repositories/%s';

    /**
     * @var \Psr\Http\Client\ClientInterface
     */
    protected ClientInterface $httpClient;

    /**
     * @var \SprykerAzure\Client\Builder\RequestBuilderInterface
     */
    protected RequestBuilderInterface $requestBuilder;

    /**
     * @var \SprykerAzure\Client\Builder\ResponseDataBuilderInterface
     */
    protected ResponseDataBuilderInterface $responseDataBuilder;

    /**
     * @param \Psr\Http\Client\ClientInterface $httpClient
     * @param \SprykerAzure\Client\Builder\RequestBuilderInterface $requestBuilder
     * @param \SprykerAzure\Client\Builder\ResponseDataBuilderInterface $responseDataBuilder
     */
    public function __construct(
        ClientInterface $httpClient,
        RequestBuilderInterface $requestBuilder,
        ResponseDataBuilderInterface $responseDataBuilder
    ) {
        $this->httpClient = $httpClient;
        $this->requestBuilder = $requestBuilder;
        $this->responseDataBuilder = $responseDataBuilder;
    }

    /**
     * @param \SprykerAzure\Api\RepositoryPath $targetRepository
     *
     * @return array<mixed>
     */
    public function getRepositoryInfo(RepositoryPath $targetRepository): array
    {
        $request = $this->requestBuilder->getRequest(
            'GET',
            $this->createUrlPath($targetRepository),
        );

        $response = $this->httpClient->sendRequest($request);

        return $this->responseDataBuilder->getResponseData($response);
    }

    /**
     * @param \SprykerAzure\Api\RepositoryPath $targetRepository
     *
     * @return \Psr\Http\Message\UriInterface
     */
    protected function createUrlPath(RepositoryPath $targetRepository): UriInterface
    {
        return new Uri(
            sprintf(
                static::API_ENDPOINT_URL,
                $targetRepository->getOrganizationName(),
                $targetRepository->getProjectName(),
                $targetRepository->getRepositoryId(),
            ),
        );
    }
}

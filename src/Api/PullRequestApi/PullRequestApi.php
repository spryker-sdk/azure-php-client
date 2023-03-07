<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzure\Api\PullRequestApi;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\UriInterface;
use SprykerAzure\Api\RepositoryPath;
use SprykerAzure\Client\Builder\RequestBuilderInterface;
use SprykerAzure\Client\Builder\ResponseDataBuilderInterface;

class PullRequestApi implements PullRequestApiInterface
{
    /**
     * @var string
     */
    protected const PR_WEB_URL = 'https://dev.azure.com/%s/%s/_git/%s/pullrequest/%s';

    /**
     * @var string
     */
    protected const REF_HEADS_PREFIX = 'refs/heads/';

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
     * @param \SprykerAzure\Api\PullRequestApi\PullRequestData $pullRequestData
     *
     * @return array<mixed>
     */
    public function createPullRequest(RepositoryPath $targetRepository, PullRequestData $pullRequestData): array
    {
        $request = $this->requestBuilder->getRequest(
            'POST',
            $this->createUrlPath($targetRepository),
            [],
            $this->serializePullRequestData($pullRequestData),
        );

        $response = $this->httpClient->sendRequest($request);

        $responseData = $this->responseDataBuilder->getResponseData($response);

        return $this->addPullRequestWebUrl($responseData, $targetRepository);
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
                '/%s/%s/_apis/git/repositories/%s/pullrequests',
                $targetRepository->getOrganizationName(),
                $targetRepository->getProjectName(),
                $targetRepository->getRepositoryId(),
            ),
        );
    }

    /**
     * @param \SprykerAzure\Api\PullRequestApi\PullRequestData $pullRequestData
     *
     * @return string
     */
    protected function serializePullRequestData(PullRequestData $pullRequestData): string
    {
        $data = [
            'sourceRefName' => strpos($pullRequestData->getSourceBranch(), static::REF_HEADS_PREFIX) !== 0
                ? static::REF_HEADS_PREFIX . $pullRequestData->getSourceBranch()
                : $pullRequestData->getSourceBranch(),
            'targetRefName' => strpos($pullRequestData->getTargetBranch(), static::REF_HEADS_PREFIX) !== 0
                ? static::REF_HEADS_PREFIX . $pullRequestData->getTargetBranch()
                : $pullRequestData->getTargetBranch(),
            'title' => $pullRequestData->getTitle(),
        ];

        if ($pullRequestData->getDescription() !== null) {
            $data['description'] = $pullRequestData->getDescription();
        }

        return json_encode($data, \JSON_THROW_ON_ERROR);
    }

    /**
     * @param array<mixed> $responseData
     * @param \SprykerAzure\Api\RepositoryPath $targetRepository
     *
     * @return array<mixed>
     */
    protected function addPullRequestWebUrl(array $responseData, RepositoryPath $targetRepository): array
    {
        $responseData['webUrl'] = sprintf(
            static::PR_WEB_URL,
            $targetRepository->getOrganizationName(),
            $targetRepository->getProjectName(),
            $targetRepository->getRepositoryId(),
            $responseData['pullRequestId'] ?? '',
        );

        return $responseData;
    }
}

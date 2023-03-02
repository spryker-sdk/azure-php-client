<?php

declare(strict_types=1);

namespace Azure\Api\PullRequestApi;

use Azure\Api\RepositoryPath;
use Azure\Api\ResponseProcessorInterface;
use Azure\Client\RequestBuilder\RequestBuilderInterface;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\UriInterface;

class PullRequestApi implements PullRequestApiInterface
{
    protected const REF_HEADS_PREFIX = 'refs/heads/';

    /**
     * @var \Azure\Client\RequestBuilder\RequestBuilderInterface
     */
    protected RequestBuilderInterface $requestBuilder;

    /**
     * @var \Psr\Http\Client\ClientInterface
     */
    protected ClientInterface $httpClient;

    /**
     * @var \Azure\Api\ResponseProcessorInterface
     */
    protected ResponseProcessorInterface $responseProcessor;

    public function __construct(
        RequestBuilderInterface $requestBuilder,
        ClientInterface $httpClient,
        ResponseProcessorInterface $responseProcessor
    ) {
        $this->requestBuilder = $requestBuilder;
        $this->httpClient = $httpClient;
        $this->responseProcessor = $responseProcessor;
    }

    /**
     * @param \Azure\Api\RepositoryPath $targetRepository
     * @param \Azure\Api\PullRequestApi\PullRequestData $pullRequestData
     *
     * @return array<mixed>
     */
    public function createPullRequest(RepositoryPath $targetRepository, PullRequestData $pullRequestData): array
    {
        $request = $this->requestBuilder->getRequest(
            'POST',
            $this->createUrlPath($targetRepository),
            [],
            $this->serializePullRequestData($pullRequestData)
        );

        $response = $this->httpClient->sendRequest($request);

        return $this->responseProcessor->process($response);
    }

    /**
     * @param \Azure\Api\RepositoryPath $targetRepository
     *
     * @return UriInterface
     */
    protected function createUrlPath(RepositoryPath $targetRepository): UriInterface
    {
        return new Uri(
            sprintf(
                '/%s/%s/_apis/git/repositories/%s/pullrequests',
                urlencode($targetRepository->getOrganizationName()),
                urlencode($targetRepository->getProjectName()),
                urlencode(
                    $targetRepository->getRepositoryId()
                )
            ));
    }

    /**
     * @param \Azure\Api\PullRequestApi\PullRequestData $pullRequestData
     *
     * @return string
     *
     * @throws \JsonException
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
}
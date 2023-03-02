<?php

namespace Azure\Api\PullRequestApi;

use Azure\Api\RepositoryPath;

interface PullRequestApiInterface
{
    /**
     * @param \Azure\Api\RepositoryPath $targetRepository
     * @param \Azure\Api\PullRequestApi\PullRequestData $pullRequestData
     *
     * @return array<mixed>
     */
    public function createPullRequest(RepositoryPath $targetRepository, PullRequestData $pullRequestData): array;
}
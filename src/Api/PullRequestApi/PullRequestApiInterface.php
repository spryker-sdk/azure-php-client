<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzure\Api\PullRequestApi;

use SprykerAzure\Api\RepositoryPath;

interface PullRequestApiInterface
{
    /**
     * @param \SprykerAzure\Api\RepositoryPath $targetRepository
     * @param \SprykerAzure\Api\PullRequestApi\PullRequestData $pullRequestData
     *
     * @return array<mixed>
     */
    public function createPullRequest(RepositoryPath $targetRepository, PullRequestData $pullRequestData): array;
}

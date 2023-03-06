<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzure\Client;

use SprykerAzure\Api\PullRequestApi\PullRequestApiInterface;
use SprykerAzure\Api\RepositoryApi\RepositoryApiInterface;

class Client implements ClientInterface
{
    /**
     * @var \SprykerAzure\Api\PullRequestApi\PullRequestApiInterface
     */
    protected PullRequestApiInterface $pullRequestApi;

    /**
     * @var \SprykerAzure\Api\RepositoryApi\RepositoryApiInterface
     */
    protected RepositoryApiInterface $repositoryApi;

    /**
     * @param \SprykerAzure\Api\PullRequestApi\PullRequestApiInterface $pullRequestApi
     * @param \SprykerAzure\Api\RepositoryApi\RepositoryApiInterface $repositoryApi
     */
    public function __construct(PullRequestApiInterface $pullRequestApi, RepositoryApiInterface $repositoryApi)
    {
        $this->pullRequestApi = $pullRequestApi;
        $this->repositoryApi = $repositoryApi;
    }

    /**
     * @return \SprykerAzure\Api\PullRequestApi\PullRequestApiInterface
     */
    public function getPullRequestApi(): PullRequestApiInterface
    {
        return $this->pullRequestApi;
    }

    /**
     * @return \SprykerAzure\Api\RepositoryApi\RepositoryApiInterface
     */
    public function getRepositoryApi(): RepositoryApiInterface
    {
        return $this->repositoryApi;
    }
}

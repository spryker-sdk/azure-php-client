<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzure\Client;

use SprykerAzure\Api\PullRequestApi\PullRequestApiInterface;
use SprykerAzure\Api\RepositoryApi\RepositoryApiInterface;

interface ClientInterface
{
    /**
     * @return \SprykerAzure\Api\PullRequestApi\PullRequestApiInterface
     */
    public function getPullRequestApi(): PullRequestApiInterface;

    /**
     * @return \SprykerAzure\Api\RepositoryApi\RepositoryApiInterface
     */
    public function getRepositoryApi(): RepositoryApiInterface;
}

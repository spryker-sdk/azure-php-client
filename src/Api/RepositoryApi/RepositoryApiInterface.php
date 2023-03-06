<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzure\Api\RepositoryApi;

use SprykerAzure\Api\RepositoryPath;

interface RepositoryApiInterface
{
    /**
     * @param \SprykerAzure\Api\RepositoryPath $targetRepository
     *
     * @return array<mixed>
     */
    public function getRepositoryInfo(RepositoryPath $targetRepository): array;
}

<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzure\Api;

class RepositoryPath
{
    /**
     * @var string
     */
    protected string $organizationName;

    /**
     * @var string
     */
    protected string $projectName;

    /**
     * @var string
     */
    protected string $repositoryId;

    /**
     * @param string $organizationName
     * @param string $projectName
     * @param string $repositoryId
     */
    public function __construct(string $organizationName, string $projectName, string $repositoryId)
    {
        $this->organizationName = $organizationName;
        $this->projectName = $projectName;
        $this->repositoryId = $repositoryId;
    }

    /**
     * @return string
     */
    public function getOrganizationName(): string
    {
        return $this->organizationName;
    }

    /**
     * Project ID can be used instead
     *
     * @return string
     */
    public function getProjectName(): string
    {
        return $this->projectName;
    }

    /**
     * @return string
     */
    public function getRepositoryId(): string
    {
        return $this->repositoryId;
    }
}

<?php

declare(strict_types=1);

namespace Azure\Api;

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
<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzure\Api\PullRequestApi;

class PullRequestData
{
    /**
     * @var string
     */
    protected string $title;

    /**
     * @var string
     */
    protected string $targetBranch;

    /**
     * @var string
     */
    protected string $sourceBranch;

    /**
     * @var string|null
     */
    protected ?string $description;

    /**
     * @param string $title
     * @param string $targetBranch
     * @param string $sourceBranch
     * @param string|null $description
     */
    public function __construct(string $title, string $targetBranch, string $sourceBranch, ?string $description = null)
    {
        $this->title = $title;
        $this->targetBranch = $targetBranch;
        $this->sourceBranch = $sourceBranch;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getTargetBranch(): string
    {
        return $this->targetBranch;
    }

    /**
     * @return string
     */
    public function getSourceBranch(): string
    {
        return $this->sourceBranch;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
}

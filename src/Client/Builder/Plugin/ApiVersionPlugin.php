<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzure\Client\Builder\Plugin;

use Psr\Http\Message\RequestInterface;

class ApiVersionPlugin implements RequestPluginInterface
{
    /**
     * @var string
     */
    protected const DEFAULT_API_VERSION = '7.0';

    /**
     * @var string
     */
    protected string $apiVersion;

    /**
     * @param string $apiVersion
     */
    public function __construct(string $apiVersion = self::DEFAULT_API_VERSION)
    {
        $this->apiVersion = $apiVersion;
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function apply(RequestInterface $request): RequestInterface
    {
        $uri = $request->getUri()->withQuery(sprintf('api-version=%s', $this->apiVersion));

        return $request->withUri($uri);
    }
}

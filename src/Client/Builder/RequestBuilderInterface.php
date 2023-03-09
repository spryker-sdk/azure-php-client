<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzure\Client\Builder;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;
use SprykerAzure\Client\Plugin\Request\RequestPluginInterface;

interface RequestBuilderInterface
{
    /**
     * @param \SprykerAzure\Client\Plugin\Request\RequestPluginInterface $requestPlugin
     *
     * @return void
     */
    public function addRequestPlugin(RequestPluginInterface $requestPlugin): void;

    /**
     * @param string $method
     * @param \Psr\Http\Message\UriInterface $uri
     * @param array<string, string|array<string>> $headers
     * @param string|null $body
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getRequest(string $method, UriInterface $uri, array $headers = [], ?string $body = null): RequestInterface;
}

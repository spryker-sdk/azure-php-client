<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzure\Client\Plugin\Request;

use InvalidArgumentException;
use Psr\Http\Message\RequestInterface;

class BaseUrlPlugin implements RequestPluginInterface
{
    /**
     * @var string
     */
    public const DEFAULT_AZURE_GIT_URL = 'https://dev.azure.com';

    /**
     * @var string
     */
    protected string $baseUrl;

    /**
     * @param string $baseUrl
     */
    public function __construct(string $baseUrl = self::DEFAULT_AZURE_GIT_URL)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @throws \InvalidArgumentException
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function apply(RequestInterface $request): RequestInterface
    {
        $urlEntities = parse_url($this->baseUrl);

        if (!isset($urlEntities['scheme'], $urlEntities['host'])) {
            throw new InvalidArgumentException('Provide base utl with scheme and host');
        }

        $uri = $request->getUri()->withScheme($urlEntities['scheme'])->withHost($urlEntities['host']);

        return $request->withUri($uri);
    }
}

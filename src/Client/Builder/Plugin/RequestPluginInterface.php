<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzure\Client\Builder\Plugin;

use Psr\Http\Message\RequestInterface;

interface RequestPluginInterface
{
    /**
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function apply(RequestInterface $request): RequestInterface;
}

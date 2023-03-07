<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzure\Client\Plugin\Response;

use Psr\Http\Message\ResponseInterface;

interface ResponsePluginInterface
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param array<mixed> $responseData
     *
     * @return array<mixed>
     */
    public function apply(ResponseInterface $response, array $responseData): array;
}

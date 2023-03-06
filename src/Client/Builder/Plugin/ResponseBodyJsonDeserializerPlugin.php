<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzure\Client\Builder\Plugin;

use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;

class ResponseBodyJsonDeserializerPlugin implements ResponsePluginInterface
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param array<mixed> $responseData
     *
     * @throws \InvalidArgumentException
     *
     * @return array<mixed>
     */
    public function apply(ResponseInterface $response, array $responseData): array
    {
        $data = json_decode((string)$response->getBody(), true, 512, \JSON_THROW_ON_ERROR);

        if (!is_array($data)) {
            throw new InvalidArgumentException(sprintf('Unexpected response data %s', var_export($data, true)));
        }

        return array_merge($responseData, $data);
    }
}

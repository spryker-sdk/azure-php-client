<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzure\Client\Plugin\Response;

use Psr\Http\Message\ResponseInterface;
use SprykerAzure\Exception\InvalidClientRequestException;
use SprykerAzure\Exception\ServerErrorResponseException;

class ResponseStatusCheckPlugin implements ResponsePluginInterface
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param array<mixed> $responseData
     *
     * @throws \SprykerAzure\Exception\InvalidClientRequestException
     * @throws \SprykerAzure\Exception\ServerErrorResponseException
     *
     * @return array<mixed>
     */
    public function apply(ResponseInterface $response, array $responseData): array
    {
        if ($response->getStatusCode() >= 400 && $response->getStatusCode() < 500) {
            throw new InvalidClientRequestException($this->getErrorMessage($response));
        }

        if ($response->getStatusCode() >= 500) {
            throw new ServerErrorResponseException($this->getErrorMessage($response));
        }

        return $responseData;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return string
     */
    protected function getErrorMessage(ResponseInterface $response): string
    {
        return sprintf('Invalid azure response: %s %s', $response->getStatusCode(), (string)$response->getBody());
    }
}

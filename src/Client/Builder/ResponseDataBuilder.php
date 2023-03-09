<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzure\Client\Builder;

use Psr\Http\Message\ResponseInterface;
use SprykerAzure\Client\Plugin\Response\ResponsePluginInterface;

class ResponseDataBuilder implements ResponseDataBuilderInterface
{
    /**
     * @var array<\SprykerAzure\Client\Plugin\Response\ResponsePluginInterface>
     */
    protected array $responsePlugins = [];

    /**
     * @param array<\SprykerAzure\Client\Plugin\Response\ResponsePluginInterface> $responsePlugins
     */
    public function __construct(array $responsePlugins = [])
    {
        $this->responsePlugins = $responsePlugins;
    }

    /**
     * @param \SprykerAzure\Client\Plugin\Response\ResponsePluginInterface $responsePlugin
     *
     * @return void
     */
    public function addResponsePlugin(ResponsePluginInterface $responsePlugin): void
    {
        $this->responsePlugins[] = $responsePlugin;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return array<mixed>
     */
    public function getResponseData(ResponseInterface $response): array
    {
        $responseData = [];

        foreach ($this->responsePlugins as $responsePlugin) {
            $responseData = $responsePlugin->apply($response, $responseData);
        }

        return $responseData;
    }
}

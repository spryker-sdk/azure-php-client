<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzureTest\Client\Builder\Plugin;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use SprykerAzure\Client\Builder\Plugin\ResponseThrowablePlugin;
use SprykerAzure\Exception\InvalidClientRequestException;
use SprykerAzure\Exception\ServerErrorResponseException;

class ResponseThrowablePluginTest extends TestCase
{
    /**
     * @return void
     */
    public function testApplyShouldThrowExceptionWhenClientErrorResponseReceived(): void
    {
        // Arrange
        $response = new Response(400, [], '');
        $plugin = new ResponseThrowablePlugin();

        $this->expectException(InvalidClientRequestException::class);

        // Act
        $plugin->apply($response, []);
    }

    /**
     * @return void
     */
    public function testApplyShouldThrowExceptionWhenServerErrorResponseReceived(): void
    {
        // Arrange
        $response = new Response(500, [], '');
        $plugin = new ResponseThrowablePlugin();

        $this->expectException(ServerErrorResponseException::class);

        // Act
        $plugin->apply($response, []);
    }
}

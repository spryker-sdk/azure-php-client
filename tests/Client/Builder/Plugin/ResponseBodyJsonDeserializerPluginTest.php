<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzureTest\Client\Builder\Plugin;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use SprykerAzure\Client\Builder\Plugin\ResponseBodyJsonDeserializerPlugin;

class ResponseBodyJsonDeserializerPluginTest extends TestCase
{
    /**
     * @return void
     */
    public function testApplyShouldReturnJsonDeserializedArray(): void
    {
        // Arrange
        $response = new Response(200, [], '{"property": "property-value"}');
        $plugin = new ResponseBodyJsonDeserializerPlugin();

        // Act
        $responseData = $plugin->apply($response, []);

        // Assert
        $this->assertSame(['property' => 'property-value'], $responseData);
    }
}

<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzureTest\Client\Builder;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use SprykerAzure\Client\Builder\Plugin\ResponseBodyJsonDeserializerPlugin;
use SprykerAzure\Client\Builder\ResponseDataBuilder;

class ResponseDataBuilderTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetResponseDataShouldReturnResponseDataWithAppliedPlugins(): void
    {
        // Arrange
        $responseDataBuilder = new ResponseDataBuilder();
        $responseData = new Response(200, [], '{"property": "property-value"}');

        // Act
        $responseDataBuilder->addResponsePlugin(new ResponseBodyJsonDeserializerPlugin());
        $responseData = $responseDataBuilder->getResponseData($responseData);

        // Assert
        $this->assertSame(['property' => 'property-value'], $responseData);
    }
}

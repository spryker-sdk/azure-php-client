<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzureTest\Client\Builder;

use GuzzleHttp\Psr7\Uri;
use PHPUnit\Framework\TestCase;
use SprykerAzure\Client\Builder\RequestBuilder;
use SprykerAzure\Client\Plugin\Request\BaseUrlPlugin;

class RequestBuilderTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetRequestShouldReturnRequestWithAppliedPlugins(): void
    {
        // Arrange
        $requestBuilder = new RequestBuilder();

        // Act
        $requestBuilder->addRequestPlugin(new BaseUrlPlugin());
        $request = $requestBuilder->getRequest('POST', new Uri('http//some-url.com/some-path/'));

        // Assert
        $this->assertSame('dev.azure.com', $request->getUri()->getHost());
    }
}

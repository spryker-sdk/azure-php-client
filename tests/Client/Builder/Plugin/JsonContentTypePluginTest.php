<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzureTest\Client\Builder\Plugin;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use PHPUnit\Framework\TestCase;
use SprykerAzure\Client\Plugin\Request\JsonContentTypePlugin;

class JsonContentTypePluginTest extends TestCase
{
    /**
     * @return void
     */
    public function testApplyShouldReturnJsonDecodedData(): void
    {
        // Arrange
        $request = new Request('POST', new Uri('https://host.com'));
        $plugin = new JsonContentTypePlugin();

        // Act
        $request = $plugin->apply($request);

        // Assert
        $this->assertSame(['application/json'], $request->getHeader('Content-Type'));
    }
}

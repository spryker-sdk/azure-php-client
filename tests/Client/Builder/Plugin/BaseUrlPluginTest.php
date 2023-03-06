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
use SprykerAzure\Client\Builder\Plugin\BaseUrlPlugin;

class BaseUrlPluginTest extends TestCase
{
    /**
     * @return void
     */
    public function testApplyShouldSetBaseUrlToRequest(): void
    {
        // Arrange
        $request = new Request('POST', new Uri('https://host.com'));
        $plugin = new BaseUrlPlugin('http://new-url.com');

        // Act
        $request = $plugin->apply($request);

        // Assert
        $this->assertSame('new-url.com', $request->getUri()->getHost());
        $this->assertSame('http', $request->getUri()->getScheme());
    }
}

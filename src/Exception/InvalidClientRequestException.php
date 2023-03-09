<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace SprykerAzure\Exception;

use Exception;
use Psr\Http\Client\ClientExceptionInterface;

class InvalidClientRequestException extends Exception implements ClientExceptionInterface
{
}

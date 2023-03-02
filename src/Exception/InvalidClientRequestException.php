<?php

declare(strict_types=1);

namespace Azure\Exception;

use Psr\Http\Client\ClientExceptionInterface;

class InvalidClientRequestException extends \Exception implements ClientExceptionInterface
{
}
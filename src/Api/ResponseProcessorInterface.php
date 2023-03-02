<?php

declare(strict_types=1);

namespace Azure\Api;

use Psr\Http\Message\ResponseInterface;

interface ResponseProcessorInterface
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return array<mixed>
     *
     * @throws \Azure\Exception\InvalidClientRequestException
     * @throws \Azure\Exception\ServerErrorResponseException
     * @throws \JsonException
     */
    public function process(ResponseInterface $response): array;
}
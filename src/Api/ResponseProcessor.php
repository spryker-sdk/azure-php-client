<?php

declare(strict_types=1);

namespace Azure\Api;

use Azure\Exception\InvalidClientRequestException;
use Azure\Exception\ServerErrorResponseException;
use Psr\Http\Message\ResponseInterface;

class ResponseProcessor implements ResponseProcessorInterface
{
    protected const DEFAULT_JSON_DEPTH = 512;

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return array<mixed>
     *
     * @throws \Azure\Exception\InvalidClientRequestException
     * @throws \Azure\Exception\ServerErrorResponseException
     * @throws \JsonException
     */
    public function process(ResponseInterface $response): array
    {
        if ($response->getStatusCode() >= 400 && $response->getStatusCode() < 500) {
            throw new InvalidClientRequestException((string)$response->getBody());
        }

        if ($response->getStatusCode() > 500) {
            throw new ServerErrorResponseException((string)$response->getBody());
        }

        $data =  json_decode((string)$response->getBody(), true, static::DEFAULT_JSON_DEPTH, \JSON_THROW_ON_ERROR);

        if (!is_array($data)) {
            throw new \InvalidArgumentException(sprintf('Unexpected response data %s', var_export($data, true)));
        }

        return $data;
    }
}
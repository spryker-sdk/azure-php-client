<?php

declare(strict_types=1);

namespace Azure\Client;

use Azure\Api\PullRequestApi\PullRequestApi;
use Azure\Api\ResponseProcessor;
use Azure\Client\RequestBuilder\RequestBuilderInterface;
use Psr\Http\Client\ClientInterface as HttpClientInterface;

class ClientFactory
{
    public static function createClient(RequestBuilderInterface $requestBuilder, HttpClientInterface $httpClient): ClientInterface
    {
        $responseProcessor = new ResponseProcessor();

        $pullRequestApi = new PullRequestApi($requestBuilder, $httpClient, $responseProcessor);

        return new Client($pullRequestApi);
    }
}
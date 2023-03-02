<?php

namespace Azure\Client;

use Azure\Api\PullRequestApi\PullRequestApiInterface;
use Azure\Client\RequestBuilder\RequestBuilderInterface;
use Psr\Http\Client\ClientInterface as HttpClientInterface;

class Client implements ClientInterface
{
    /**
     * @var \Azure\Api\PullRequestApi\PullRequestApiInterface
     */
    protected PullRequestApiInterface $pullRequestApi;

    public function __construct(PullRequestApiInterface $pullRequestApi)
    {
        $this->pullRequestApi = $pullRequestApi;
    }

    /**
     * @return \Azure\Api\PullRequestApi\PullRequestApiInterface
     */
    public function getPullRequestApi(): PullRequestApiInterface
    {
        return $this->pullRequestApi;
    }
}
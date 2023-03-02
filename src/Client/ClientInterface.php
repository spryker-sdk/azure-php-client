<?php

namespace Azure\Client;

use Azure\Api\PullRequestApi\PullRequestApiInterface;
use Psr\Http\Message\RequestInterface;

interface ClientInterface
{
    public function getPullRequestApi(): PullRequestApiInterface;
}
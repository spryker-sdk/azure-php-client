<?php

namespace Azure\Client\RequestBuilder;

use Psr\Http\Message\RequestInterface;

interface RequestPluginInterface
{
    /**
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function apply(RequestInterface $request): RequestInterface;
}
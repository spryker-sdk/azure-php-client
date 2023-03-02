<?php

declare(strict_types=1);

namespace Azure\Client\RequestBuilder;

use Psr\Http\Message\RequestInterface;

class PersonalAccessTokenAuthPlugin implements RequestPluginInterface
{
    protected string $personalAccessToken;

    public function __construct(string $personalAccessToken)
    {
        $this->personalAccessToken = $personalAccessToken;
    }

    public function apply(RequestInterface $request): RequestInterface
    {
        return $request->withHeader('Authorization', 'Basic ' . base64_encode(':' . $this->personalAccessToken));
    }
}
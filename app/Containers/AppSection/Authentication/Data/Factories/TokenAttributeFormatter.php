<?php

namespace App\Containers\AppSection\Authentication\Data\Factories;

use League\OAuth2\Server\ResourceServer;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpFoundation\Request;

/**
 * This is a temporary solution to get the request attributes in a format that AccessToken can use.
 */
final readonly class TokenAttributeFormatter
{
    public function __construct(
        private ResourceServer $resourceServer,
    ) {
    }

    public function format(string $accessToken): array
    {
        return $this->resourceServer
            ->validateAuthenticatedRequest(
                $this->createAuthenticatedRequest($accessToken),
            )->getAttributes();
    }

    private function createAuthenticatedRequest(string $accessToken): ServerRequestInterface
    {
        return (new PsrHttpFactory())->createRequest(
            Request::create('', server: [
                'HTTP_AUTHORIZATION' => 'Bearer ' . $accessToken,
            ]),
        );
    }
}

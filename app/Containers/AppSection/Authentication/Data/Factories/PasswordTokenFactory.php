<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Data\Factories;

use App\Containers\AppSection\Authentication\Data\DTOs\PasswordToken;
use App\Containers\AppSection\Authentication\Values\RequestProxies\PasswordGrant\AccessTokenProxy;
use App\Containers\AppSection\Authentication\Values\RequestProxies\PasswordGrant\RefreshTokenProxy;
use App\Containers\AppSection\User\Models\User;
use JsonException;
use Laravel\Passport\AccessToken;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Exception\OAuthServerException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpFoundation\Request;

final class PasswordTokenFactory
{
    private null|User $user = null;

    public function __construct(
        private readonly AuthorizationServer $server,
        private readonly TokenAttributeFormatter $tokenFormatter,
    ) {
    }

    public function make(AccessTokenProxy|RefreshTokenProxy $proxy): PasswordToken
    {
        $response = $this->processTokenRequest($proxy);
        $this->updateUserTokenIfNeeded($response['access_token']);

        return PasswordToken::fromArray($response);
    }

    /**
     * Set the access token as the user's current token.
     */
    public function for(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    private function processTokenRequest(AccessTokenProxy|RefreshTokenProxy $proxy): array
    {
        return $this->dispatchRequestToAuthorizationServer(
            $this->createRequest($proxy),
        );
    }

    /**
     * @throws OAuthServerException
     * @throws JsonException
     */
    private function dispatchRequestToAuthorizationServer(ServerRequestInterface $request): array
    {
        return json_decode(
            (string) $this->server->respondToAccessTokenRequest(
                $request,
                app(ResponseInterface::class),
            )->getBody(),
            true,
            512,
            JSON_THROW_ON_ERROR,
        );
    }

    private function createRequest(AccessTokenProxy|RefreshTokenProxy $proxy): ServerRequestInterface
    {
        return (new PsrHttpFactory())->createRequest(
            Request::create(
                '',
                Request::METHOD_POST,
                $proxy->toArray(),
            ),
        );
    }

    private function updateUserTokenIfNeeded(string $accessToken): void
    {
        if (!\is_null($this->user)) {
            $this->setUserCurrentToken(
                new AccessToken(
                    $this->tokenFormatter->format($accessToken),
                ),
            );
        }
    }

    private function setUserCurrentToken(AccessToken $token): void
    {
        $this->user->refresh()->withAccessToken($token);
    }
}

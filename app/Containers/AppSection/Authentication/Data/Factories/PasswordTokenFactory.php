<?php

namespace App\Containers\AppSection\Authentication\Data\Factories;

use App\Containers\AppSection\Authentication\Data\DTOs\PasswordAccessTokenResponse;
use App\Containers\AppSection\Authentication\Data\DTOs\PasswordAccessTokenResult;
use App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\PasswordGrant\AccessTokenRequestProxy;
use App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\PasswordGrant\RefreshTokenRequestProxy;
use Laravel\Passport\Token;
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser as JwtParser;
use League\OAuth2\Server\AuthorizationServer;
use Nyholm\Psr7\Response;
use Nyholm\Psr7\ServerRequest;
use Psr\Http\Message\ServerRequestInterface;

final readonly class PasswordTokenFactory
{
    public function __construct(
        private AuthorizationServer $server,
        private TokenRepository $tokens,
        private JwtParser $jwt,
    ) {
    }

    public function make(AccessTokenRequestProxy|RefreshTokenRequestProxy $proxy): PasswordAccessTokenResult
    {
        $response = $this->dispatchRequestToAuthorizationServer(
            $this->createRequest($proxy),
        );

        $token = tap($this->findAccessToken($response), function (Token $token) {
            $this->tokens->save($token->forceFill([
                'user_id' => $token->user_id,
            ]));
        });

        return new PasswordAccessTokenResult($response, $token);
    }

    protected function dispatchRequestToAuthorizationServer(ServerRequestInterface $request): PasswordAccessTokenResponse
    {
        return PasswordAccessTokenResponse::fromArray(
            json_decode(
                (string) $this->server->respondToAccessTokenRequest(
                    $request,
                    new Response(),
                )->getBody(),
                true,
                512,
                JSON_THROW_ON_ERROR,
            ),
        );
    }

    protected function createRequest(AccessTokenRequestProxy|RefreshTokenRequestProxy $proxy): ServerRequestInterface
    {
        return (new ServerRequest('POST', 'not-important'))
            ->withParsedBody($proxy->toArray());
    }

    public function findAccessToken(PasswordAccessTokenResponse $response): Token
    {
        return $this->tokens->find(
            $this->jwt->parse($response->accessToken)->claims()->get('jti'),
        );
    }
}

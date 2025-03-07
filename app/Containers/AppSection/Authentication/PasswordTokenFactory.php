<?php

namespace App\Containers\AppSection\Authentication;

use App\Containers\AppSection\Authentication\Data\DTOs\PasswordToken;
use App\Containers\AppSection\Authentication\Values\RequestProxies\PasswordGrant\AccessTokenProxy;
use App\Containers\AppSection\Authentication\Values\RequestProxies\PasswordGrant\RefreshTokenProxy;
use App\Containers\AppSection\User\Models\User;
use Laravel\Passport\Token;
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser as JwtParser;
use League\OAuth2\Server\AuthorizationServer;
use Nyholm\Psr7\Response;
use Nyholm\Psr7\ServerRequest;
use Psr\Http\Message\ServerRequestInterface;

final class PasswordTokenFactory
{
    private User|null $user = null;

    public function __construct(
        private readonly AuthorizationServer $server,
        private readonly TokenRepository $tokens,
        private readonly JwtParser $jwt,
    ) {
    }

    public function make(AccessTokenProxy|RefreshTokenProxy $proxy): PasswordToken
    {
        $response = $this->dispatchRequestToAuthorizationServer(
            $this->createRequest($proxy),
        );

        $token = $this->findAccessToken($response);
        tap($token, function (Token $token) {
            $this->tokens->save($token->forceFill([
                'user_id' => $token->user_id,
            ]));
        });

        if (!is_null($this->user)) {
            $this->setUserCurrentToken($token);
        }

        return $response;
    }

    protected function dispatchRequestToAuthorizationServer(ServerRequestInterface $request): PasswordToken
    {
        return PasswordToken::fromArray(
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

    protected function createRequest(AccessTokenProxy|RefreshTokenProxy $proxy): ServerRequestInterface
    {
        return (new ServerRequest('POST', 'not-important'))
            ->withParsedBody($proxy->toArray());
    }

    public function findAccessToken(PasswordToken $token): Token
    {
        return $this->tokens->find(
            $this->jwt->parse($token->accessToken)->claims()->get('jti'),
        );
    }

    private function setUserCurrentToken(Token $token): void
    {
        $this->user->refresh()->withAccessToken($token);
    }

    /**
     * Set the access token as the user's current token.
     */
    public function for(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}

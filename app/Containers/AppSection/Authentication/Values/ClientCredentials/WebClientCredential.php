<?php

namespace App\Containers\AppSection\Authentication\Values\ClientCredentials;

use App\Ship\Parents\Values\Value as ParentValue;
use Laravel\Passport\Client as PassportClient;
use Webmozart\Assert\Assert;

final readonly class WebClientCredential extends ParentValue implements ClientCredential
{
    private function __construct(
        private int $id,
        private string $secret,
    ) {
    }

    public static function create(): self
    {
        Assert::notNull(config('appSection-authentication.clients.web.id'), 'The web client id is not set');
        Assert::notNull(config('appSection-authentication.clients.web.secret'), 'The web client secret is not set');

        return new self(
            (int) config('appSection-authentication.clients.web.id'),
            config('appSection-authentication.clients.web.secret'),
        );
    }

    // TODO: see where and how it is used and see if it can be improved
    public static function fake(): self
    {
        $provider = array_key_exists('users', config('auth.providers')) ? 'users' : null;

        $passwordClient = PassportClient::factory()
            ->asPasswordClient()
            ->createOne(['provider' => $provider]);

        config(['appSection-authentication.clients.web.id' => $passwordClient->id]);
        config(['appSection-authentication.clients.web.secret' => $passwordClient->secret]);

        return new self($passwordClient->id, $passwordClient->secret);
    }

    public function toArray(): array
    {
        return [
            'client_id' => $this->id,
            'client_secret' => $this->secret,
        ];
    }

    public function id(): int
    {
        return $this->id;
    }

    public function secret(): string
    {
        return $this->secret;
    }
}

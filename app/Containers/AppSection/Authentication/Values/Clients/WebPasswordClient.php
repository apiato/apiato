<?php

namespace App\Containers\AppSection\Authentication\Values\Clients;

use App\Ship\Parents\Values\Value as ParentValue;
use Laravel\Passport\Client as PassportClient;
use Webmozart\Assert\Assert;

final readonly class WebPasswordClient extends ParentValue implements Client
{
    private PassportClient $client;

    public function __construct(
        private int $id,
        private string $secret,
    ) {
        $this->client = PassportClient::query()->where([
            'id' => $this->id,
            'secret' => $this->secret,
            'password_client' => true,
        ])->firstOrFail();
    }

    public static function create(): self
    {
        $id = (int) config('appSection-authentication.clients.web.id');
        $secret = config('appSection-authentication.clients.web.secret');

        Assert::notNull($id, 'The web client id is not set');
        Assert::notNull($secret, 'The web client secret is not set');

        return new self($id, $secret);
    }

    public function id(): mixed
    {
        return $this->instance()->getKey();
    }

    public function secret(): string
    {
        return $this->instance()->secret;
    }

    public function instance(): PassportClient
    {
        return $this->client;
    }
}

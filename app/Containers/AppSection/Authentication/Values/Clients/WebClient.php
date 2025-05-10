<?php

namespace App\Containers\AppSection\Authentication\Values\Clients;

use App\Ship\Parents\Values\Value as ParentValue;
use Laravel\Passport\Client as PassportClient;
use Webmozart\Assert\Assert;

final readonly class WebClient extends ParentValue implements Client
{
    private const ID_CONFIG_KEY = 'appSection-authentication.clients.web.id';
    private const SECRET_CONFIG_KEY = 'appSection-authentication.clients.web.secret';
    private PassportClient $client;

    public function __construct(
        private int|string $id,
        private string $secret,
    ) {
        config([self::ID_CONFIG_KEY => $this->id]);
        config([self::SECRET_CONFIG_KEY => $this->secret]);

        $this->client = PassportClient::query()
            ->where('id', $this->id)
            ->firstOrFail();
    }

    public static function create(): self
    {
        $id = config(self::ID_CONFIG_KEY);
        $secret = config(self::SECRET_CONFIG_KEY);

        Assert::stringNotEmpty($id, 'The web client id is not set');
        Assert::stringNotEmpty($secret, 'The web client secret is not set');

        return new self($id, $secret);
    }

    public function id(): mixed
    {
        return $this->instance()->getKey();
    }

    public function instance(): PassportClient
    {
        return $this->client;
    }

    public function secret(): string
    {
        return $this->instance()->secret;
    }
}

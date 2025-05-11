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
        private string $plainSecret,
    ) {
        config([self::ID_CONFIG_KEY => $this->id]);
        config([self::SECRET_CONFIG_KEY => $this->plainSecret]);

        $this->client = PassportClient::query()
            ->where('id', $this->id)
            ->firstOrFail();
    }

    public static function create(): self
    {
        $id = config(self::ID_CONFIG_KEY);
        $plainSecret = config(self::SECRET_CONFIG_KEY);

        Assert::true(
            (is_string($id) && '' !== $id) || is_int($id),
            'The web client id must be a non-empty string or an integer',
        );
        Assert::stringNotEmpty($plainSecret, 'The web client secret must be a non-empty string');

        return new self($id, $plainSecret);
    }

    public function id(): mixed
    {
        return $this->instance()->getKey();
    }

    public function instance(): PassportClient
    {
        return $this->client;
    }

    public function plainSecret(): string
    {
        return config()->string(self::SECRET_CONFIG_KEY);
    }
}

<?php

namespace App\Containers\AppSection\Authentication\Data\Factories;

use App\Containers\AppSection\Authentication\Values\Clients\WebPasswordClient;
use Laravel\Passport\Client;

final readonly class ClientFactory
{
    public static function webPasswordClient(array $attributes = []): WebPasswordClient
    {
        $provider = array_key_exists('users', config('auth.providers')) ? 'users' : null;

        $passwordClient = Client::factory()
            ->asPasswordClient()
            ->createOne([
                'provider' => $provider,
                ...$attributes,
            ]);

        config(['appSection-authentication.clients.web.id' => $passwordClient->id]);
        config(['appSection-authentication.clients.web.secret' => $passwordClient->secret]);

        return new WebPasswordClient($passwordClient->id, $passwordClient->secret);
    }
}

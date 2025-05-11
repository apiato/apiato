<?php

namespace App\Containers\AppSection\Authentication\Data\Factories;

use App\Containers\AppSection\Authentication\Values\Clients\WebClient;
use Laravel\Passport\Client;

final readonly class ClientFactory
{
    public static function webClient(array $attributes = []): WebClient
    {
        $provider = array_key_exists('users', config('auth.providers')) ? 'users' : null;

        $client = Client::factory()
            ->asPasswordClient()
            ->createOne([
                'provider' => $provider,
                ...$attributes,
            ]);

        return new WebClient($client->id, $client->plainSecret);
    }
}

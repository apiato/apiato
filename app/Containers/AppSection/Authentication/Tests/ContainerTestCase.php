<?php

namespace App\Containers\AppSection\Authentication\Tests;

use App\Containers\AppSection\Authentication\Tasks\CallOAuthServerTask;
use App\Ship\Parents\Tests\PhpUnit\TestCase as ParentTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ContainerTestCase extends ParentTestCase
{
    protected const OAUTH_PUBLIC_KEY_NAME = 'oauth-public.key';
    protected const OAUTH_PRIVATE_KEY_NAME = 'oauth-private.key';
    protected string|null $clientId = null;
    protected string|null $clientSecret = null;
    private bool $publicKeyCreated = false;
    private bool $privateKeyCreated = false;

    final public function createOAuthTestingKeys(): void
    {
        $this->createOAuthPublicTestingKey();
        $this->createOAuthPrivateTestingKey();
    }

    private function createOAuthPublicTestingKey(): void
    {
        $this->publicKeyCreated = $this->createOAuthTestingKey(static::OAUTH_PUBLIC_KEY_NAME);
    }

    private function createOAuthTestingKey(string $key): bool
    {
        $from = __DIR__ . '/Stubs/' . $key;
        $to = storage_path($key);

        if (!file_exists($to)) {
            copy($from, $to);

            return true;
        }

        return false;
    }

    private function createOAuthPrivateTestingKey(): void
    {
        $this->privateKeyCreated = $this->createOAuthTestingKey(static::OAUTH_PRIVATE_KEY_NAME);
    }

    final public function createPasswordGrantClient(string $clientId, string $clientSecret): void
    {
        Artisan::call('passport:install', ['--force' => true]);

        $client = DB::table('oauth_clients')->where('password_client', 1)->first();
        $this->clientId = $client->id;
        $this->clientSecret = $client->secret;

        Config::set('appSection-authentication.clients.web.id', $this->clientId);
        Config::set('appSection-authentication.clients.web.secret', $this->clientSecret);
    }

    final public function createRefreshTokenFor(string $email, string $password): mixed
    {
        return app(CallOAuthServerTask::class)->run($this->enrichWithPasswordGrantFields($email, $password))['refresh_token'];
    }

    final public function enrichWithPasswordGrantFields(string $email, string $password): array
    {
        return [
            'grant_type' => 'password',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'username' => $email,
            'password' => $password,
            'scope' => '',
        ];
    }

    final public function createAccessTokenFor(string $email, string $password): mixed
    {
        return app(CallOAuthServerTask::class)->run($this->enrichWithPasswordGrantFields($email, $password))['access_token'];
    }

    protected function tearDown(): void
    {
        $publicKey = storage_path(static::OAUTH_PUBLIC_KEY_NAME);
        if ($this->publicKeyCreated && file_exists($publicKey)) {
            unlink($publicKey);
        }

        $privateKey = storage_path(static::OAUTH_PRIVATE_KEY_NAME);
        if ($this->privateKeyCreated && file_exists($privateKey)) {
            unlink($privateKey);
        }

        parent::tearDown();
    }
}

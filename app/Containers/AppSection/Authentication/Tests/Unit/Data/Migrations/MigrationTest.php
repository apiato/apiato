<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Data\Migrations;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class MigrationTest extends UnitTestCase
{
    public function testOAuthAuthCodesTableHasExpectedColumns(): void
    {
        $columns = [
            'id' => 'bpchar',
            'user_id' => 'int8',
            'client_id' => 'uuid',
            'scopes' => 'text',
            'revoked' => 'bool',
            'expires_at' => 'timestamp',
        ];

        $this->assertDatabaseTable('oauth_auth_codes', $columns);
    }

    public function testOAuthAccessTokenTableHasExpectedColumns(): void
    {
        $columns = [
            'id' => 'bpchar',
            'user_id' => 'int8',
            'client_id' => 'uuid',
            'name' => 'varchar',
            'scopes' => 'text',
            'revoked' => 'bool',
            'created_at' => 'timestamp',
            'updated_at' => 'timestamp',
            'expires_at' => 'timestamp',
        ];

        $this->assertDatabaseTable('oauth_access_tokens', $columns);
    }

    public function testOAuthRefreshTokenTableHasExpectedColumns(): void
    {
        $columns = [
            'id' => 'bpchar',
            'access_token_id' => 'bpchar',
            'revoked' => 'bool',
            'expires_at' => 'timestamp',
        ];

        $this->assertDatabaseTable('oauth_refresh_tokens', $columns);
    }

    public function testOAuthClientsTableHasExpectedColumns(): void
    {
        $columns = [
            'id' => 'uuid',
            'owner_type' => 'varchar',
            'owner_id' => 'int8',
            'name' => 'varchar',
            'secret' => 'varchar',
            'provider' => 'varchar',
            'redirect_uris' => 'text',
            'grant_types' => 'text',
            'revoked' => 'bool',
            'created_at' => 'timestamp',
            'updated_at' => 'timestamp',
        ];

        $this->assertDatabaseTable('oauth_clients', $columns);
    }

    public function testOAuthDeviceCodesTableHasExpectedColumns(): void
    {
        $columns = [
            'id' => 'bpchar',
            'user_id' => 'int8',
            'client_id' => 'uuid',
            'user_code' => 'bpchar',
            'scopes' => 'text',
            'revoked' => 'bool',
            'user_approved_at' => 'timestamp',
            'last_polled_at' => 'timestamp',
            'expires_at' => 'timestamp',
        ];

        $this->assertDatabaseTable('oauth_device_codes', $columns);
    }
}

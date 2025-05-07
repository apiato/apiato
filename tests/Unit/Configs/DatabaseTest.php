<?php

namespace Tests\Unit\Configs;

use App\Ship\Tests\ShipTestCase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class DatabaseTest extends ShipTestCase
{
    public function testConfigHasCorrectValues(): void
    {
        $config = config('database');
        $paraTestDBSuffix = env('TEST_TOKEN') ? '_test_' . env('TEST_TOKEN') : '';
        $expected = [
            'default' => env('DB_CONNECTION', 'sqlite'),
            'connections' => [
                'sqlite' => [
                    'driver' => 'sqlite',
                    'url' => env('DB_URL'),
                    'database' => env('DB_DATABASE', database_path('database.sqlite')),
                    'prefix' => '',
                    'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
                    'busy_timeout' => null,
                    'journal_mode' => null,
                    'synchronous' => null,
                ],
                'mysql' => [
                    'driver' => 'mysql',
                    'url' => env('DB_URL'),
                    'host' => env('DB_HOST', '127.0.0.1'),
                    'port' => env('DB_PORT', '3306'),
                    'database' => env('DB_DATABASE', 'laravel'),
                    'username' => env('DB_USERNAME', 'root'),
                    'password' => env('DB_PASSWORD', ''),
                    'unix_socket' => env('DB_SOCKET', ''),
                    'charset' => env('DB_CHARSET', 'utf8mb4'),
                    'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
                    'prefix' => '',
                    'prefix_indexes' => true,
                    'strict' => true,
                    'engine' => null,
                    'options' => extension_loaded('pdo_mysql') ? array_filter([
                        \PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
                    ]) : [],
                ],
                'mariadb' => [
                    'driver' => 'mariadb',
                    'url' => env('DB_URL'),
                    'host' => env('DB_HOST', '127.0.0.1'),
                    'port' => env('DB_PORT', '3306'),
                    'database' => env('DB_DATABASE', 'laravel'),
                    'username' => env('DB_USERNAME', 'root'),
                    'password' => env('DB_PASSWORD', ''),
                    'unix_socket' => env('DB_SOCKET', ''),
                    'charset' => env('DB_CHARSET', 'utf8mb4'),
                    'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
                    'prefix' => '',
                    'prefix_indexes' => true,
                    'strict' => true,
                    'engine' => null,
                    'options' => extension_loaded('pdo_mysql') ? array_filter([
                        \PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
                    ]) : [],
                ],
                'pgsql' => [
                    'driver' => 'pgsql',
                    'url' => env('DB_URL'),
                    'host' => env('DB_HOST', '127.0.0.1'),
                    'port' => env('DB_PORT', '5432'),
                    'database' => env('DB_DATABASE', 'laravel') . $paraTestDBSuffix,
                    'username' => env('DB_USERNAME', 'root'),
                    'password' => env('DB_PASSWORD', ''),
                    'charset' => env('DB_CHARSET', 'utf8'),
                    'prefix' => '',
                    'prefix_indexes' => true,
                    'search_path' => 'public',
                    'sslmode' => 'prefer',
                ],
                'sqlsrv' => [
                    'driver' => 'sqlsrv',
                    'url' => env('DB_URL'),
                    'host' => env('DB_HOST', 'localhost'),
                    'port' => env('DB_PORT', '1433'),
                    'database' => env('DB_DATABASE', 'laravel'),
                    'username' => env('DB_USERNAME', 'root'),
                    'password' => env('DB_PASSWORD', ''),
                    'charset' => env('DB_CHARSET', 'utf8'),
                    'prefix' => '',
                    'prefix_indexes' => true,
                ],
            ],
            'migrations' => [
                'table' => 'migrations',
                'update_date_on_publish' => true,
            ],
            'redis' => [
                'client' => env('REDIS_CLIENT', 'phpredis'),
                'options' => [
                    'cluster' => env('REDIS_CLUSTER', 'redis'),
                    'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_') . '_database_'),
                ],
                'default' => [
                    'url' => env('REDIS_URL'),
                    'host' => env('REDIS_HOST', '127.0.0.1'),
                    'username' => env('REDIS_USERNAME'),
                    'password' => env('REDIS_PASSWORD'),
                    'port' => env('REDIS_PORT', '6379'),
                    'database' => env('REDIS_DB', '0'),
                ],
                'cache' => [
                    'url' => env('REDIS_URL'),
                    'host' => env('REDIS_HOST', '127.0.0.1'),
                    'username' => env('REDIS_USERNAME'),
                    'password' => env('REDIS_PASSWORD'),
                    'port' => env('REDIS_PORT', '6379'),
                    'database' => env('REDIS_CACHE_DB', '1'),
                ],
            ],
        ];

        $this->assertEqualsCanonicalizing($expected, $config);
    }
}

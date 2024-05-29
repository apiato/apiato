<?php

namespace App\Ship\Tests\Unit\Configs;

use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('ship')]
#[CoversNothing]
final class DebugBarConfigTest extends ShipTestCase
{
    public function testConfigHasCorrectValues(): void
    {
        $config = config('debugbar');
        $expected = [
            'enabled' => env('DEBUGBAR_ENABLED', null),
            'except' => [
                'telescope*',
                'horizon*',
            ],
            'storage' => [
                'enabled' => true,
                'open' => null,
                'driver' => 'file',
                'path' => storage_path('debugbar'),
                'connection' => null,
                'provider' => '',
                'hostname' => '127.0.0.1',
                'port' => 2304,
            ],
            'editor' => 'phpstorm',
            'remote_sites_path' => null,
            'local_sites_path' => null,
            'include_vendors' => true,
            'capture_ajax' => true,
            'add_ajax_timing' => false,
            'ajax_handler_auto_show' => true,
            'ajax_handler_enable_tab' => true,
            'error_handler' => false,
            'clockwork' => false,
            'collectors' => [
                'phpinfo' => true,
                'messages' => true,
                'time' => true,
                'memory' => true,
                'exceptions' => true,
                'log' => true,
                'db' => true,
                'views' => true,
                'route' => true,
                'auth' => false,
                'gate' => true,
                'session' => true,
                'symfony_request' => true,
                'mail' => true,
                'laravel' => false,
                'events' => false,
                'default_request' => false,
                'logs' => false,
                'files' => false,
                'config' => false,
                'cache' => false,
                'models' => true,
                'livewire' => true,
                'jobs' => false,
            ],
            'options' => [
                'time' => [
                    'memory_usage' => false,
                ],
                'messages' => [
                    'trace' => true,
                ],
                'memory' => [
                    'reset_peak' => false,
                    'with_baseline' => false,
                    'precision' => 0,
                ],
                'auth' => [
                    'show_name' => true,
                    'show_guards' => true,
                ],
                'db' => [
                    'with_params' => true,
                    'backtrace' => true,
                    'backtrace_exclude_paths' => [],
                    'timeline' => false,
                    'duration_background' => true,
                    'explain' => [
                        'enabled' => false,
                        'types' => ['SELECT'],
                    ],
                    'hints' => false,
                    'show_copy' => false,
                    'slow_threshold' => false,
                    'memory_usage' => false,
                    'soft_limit' => 100,
                    'hard_limit' => 500,
                ],
                'mail' => [
                    'timeline' => false,
                    'show_body' => true,
                ],
                'views' => [
                    'timeline' => false,
                    'data' => false,
                    'group' => 50,
                    'exclude_paths' => [
                        0 => 'vendor/filament',
                    ],
                ],
                'route' => [
                    'label' => true,
                ],
                'session' => [
                    'hiddens' => [],
                ],
                'symfony_request' => [
                    'hiddens' => [],
                ],
                'events' => [
                    'data' => false,
                ],
                'logs' => [
                    'file' => null,
                ],
                'cache' => [
                    'values' => true,
                ],
            ],
            'inject' => true,
            'route_prefix' => '_debugbar',
            'route_middleware' => [],
            'route_domain' => null,
            'theme' => env('DEBUGBAR_THEME', 'auto'),
            'debug_backtrace_limit' => 50,
        ];

        $this->assertSame($expected, $config);
    }
}

<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Configs;

use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class DebugBarTest extends ShipTestCase
{
    public function testConfigHasCorrectValues(): void
    {
        $config = config('debugbar');
        $expected = [
            'enabled'         => env('DEBUGBAR_ENABLED', null),
            'hide_empty_tabs' => true,
            'except'          => [
                'telescope*',
                'horizon*',
            ],
            'storage' => [
                'enabled'    => true,
                'open'       => null,
                'driver'     => 'file',
                'path'       => storage_path('debugbar'),
                'connection' => null,
                'provider'   => '',
                'hostname'   => '127.0.0.1',
                'port'       => 2304,
            ],
            'editor'                  => 'phpstorm',
            'remote_sites_path'       => null,
            'local_sites_path'        => null,
            'include_vendors'         => true,
            'capture_ajax'            => true,
            'add_ajax_timing'         => false,
            'ajax_handler_auto_show'  => true,
            'ajax_handler_enable_tab' => true,
            'error_handler'           => false,
            'clockwork'               => false,
            'collectors'              => [
                'phpinfo'         => false,
                'messages'        => true,
                'time'            => true,
                'memory'          => true,
                'exceptions'      => true,
                'log'             => true,
                'db'              => true,
                'views'           => true,
                'route'           => false,
                'auth'            => false,
                'gate'            => true,
                'session'         => false,
                'symfony_request' => true,
                'mail'            => true,
                'laravel'         => true,
                'events'          => false,
                'default_request' => false,
                'logs'            => false,
                'files'           => false,
                'config'          => false,
                'cache'           => false,
                'models'          => true,
                'livewire'        => true,
                'jobs'            => false,
                'pennant'         => false,
            ],
            'options' => [
                'time' => [
                    'memory_usage' => false,
                ],
                'messages' => [
                    'trace'         => true,
                    'capture_dumps' => false,
                ],
                'memory' => [
                    'reset_peak'    => false,
                    'with_baseline' => false,
                    'precision'     => 0,
                ],
                'auth' => [
                    'show_name'   => true,
                    'show_guards' => true,
                ],
                'db' => [
                    'with_params'             => true,
                    'exclude_paths'           => [],
                    'backtrace'               => true,
                    'backtrace_exclude_paths' => [],
                    'timeline'                => false,
                    'duration_background'     => true,
                    'explain'                 => [
                        'enabled' => false,
                    ],
                    'hints'          => false,
                    'show_copy'      => true,
                    'slow_threshold' => false,
                    'memory_usage'   => false,
                    'soft_limit'     => 100,
                    'hard_limit'     => 500,
                ],
                'mail' => [
                    'timeline'  => true,
                    'show_body' => true,
                ],
                'views' => [
                    'timeline'      => true,
                    'data'          => false,
                    'group'         => 50,
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
                    'label'   => true,
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
            'inject'                => true,
            'route_prefix'          => '_debugbar',
            'route_middleware'      => [],
            'route_domain'          => null,
            'theme'                 => env('DEBUGBAR_THEME', 'auto'),
            'debug_backtrace_limit' => 50,
            'defer_datasets'        => false,
        ];

        self::assertSame($expected, $config);
    }
}

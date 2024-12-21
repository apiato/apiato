<?php

namespace App\Ship\Parents\Tests;

use Apiato\Core\Abstracts\Tests\TestCase as AbstractTestCase;
use App\Ship\Enums\AuthGuard;
use Faker\Generator;
use Illuminate\Contracts\Console\Kernel as ApiatoConsoleKernel;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use JetBrains\PhpStorm\Deprecated;

abstract class TestCase extends AbstractTestCase
{
    #[Deprecated(reason: 'Laravel already provides a helper function for this', replacement: 'fake(%parameter0%)')]
    protected Generator $faker;

    public static function authGuardDataProvider(): array
    {
        return array_map(static fn (AuthGuard $guard) => [$guard->value], AuthGuard::cases());
    }

    public function createApplication(): Application
    {
        $app = require __DIR__ . '/../../../../bootstrap/app.php';

        $app->make(ApiatoConsoleKernel::class)->bootstrap();

        // create an instance of faker and make it available in all tests
        $this->faker = $app->make(Generator::class);

        return $app;
    }

    protected function afterRefreshingDatabase(): void
    {
        $provider = array_key_exists('users', config('auth.providers')) ? 'users' : null;

        Artisan::call('passport:client', ['--personal' => true, '--name' => config('app.name').' Personal Access Client']);
        Artisan::call('passport:client', ['--password' => true, '--name' => config('app.name').' Password Grant Client', '--provider' => $provider]);
    }
}

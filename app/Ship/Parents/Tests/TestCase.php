<?php

namespace App\Ship\Parents\Tests;

use Apiato\Abstract\Tests\TestCase as AbstractTestCase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Artisan;

// TODO:
//  Is there a better way to install passport?
abstract class TestCase extends AbstractTestCase
{
    use LazilyRefreshDatabase;

    protected function afterRefreshingDatabase(): void
    {
        $provider = array_key_exists('users', config('auth.providers')) ? 'users' : null;

        Artisan::call('passport:client', ['--personal' => true, '--name' => config('app.name') . ' Personal Access Client']);
        Artisan::call('passport:client', ['--password' => true, '--name' => config('app.name') . ' Password Grant Client', '--provider' => $provider]);
    }
}

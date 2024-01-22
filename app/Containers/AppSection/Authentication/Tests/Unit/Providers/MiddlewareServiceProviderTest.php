<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Providers;

use App\Containers\AppSection\Authentication\Middlewares\RedirectIfAuthenticated;
use App\Containers\AppSection\Authentication\Providers\MiddlewareServiceProvider;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(MiddlewareServiceProvider::class)]
final class MiddlewareServiceProviderTest extends UnitTestCase
{
    public function testProviderHasCorrectFields(): void
    {
        $provider = app(MiddlewareServiceProvider::class, ['app' => app()]);
        $data = [
            'middlewares' => [],
            'middlewareGroups' => [],
            'middlewareAliases' => [
                'guest' => RedirectIfAuthenticated::class,
            ],
            'middlewarePriority' => [],
        ];

        foreach ($data as $key => $value) {
            $this->assertSame($value, $this->getInaccessiblePropertyValue($provider, $key));
        }
    }
}

<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional\WEB;

use App\Containers\AppSection\Authentication\Tests\Functional\WebTestCase;
use App\Containers\AppSection\Authentication\UI\WEB\Controllers\HomePageController;
use App\Containers\AppSection\Authentication\UI\WEB\Controllers\LogoutController;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(LogoutController::class)]
final class LogoutTest extends WebTestCase
{
    public function testLogout(): void
    {
        $this->actingAs(User::factory()->createOne(), 'web');
        $this->assertAuthenticated('web');

        $response = $this->post(action(LogoutController::class));

        $response->assertRedirect(action(HomePageController::class));
        $this->assertGuest('web');
    }

    public function testLogoutWhileUnauthenticated(): void
    {
        $response = $this->post(action(LogoutController::class));

        $response->assertRedirect(action(HomePageController::class));
    }
}

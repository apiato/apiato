<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use App\Containers\AppSection\Authentication\Tasks\CreatePasswordResetTokenTask;
use App\Containers\AppSection\Authentication\Tests\TestCase;
use App\Containers\AppSection\User\Models\User;

/**
 * Class CreatePasswordResetTokenTaskTest.
 *
 * @group authentication
 * @group unit
 */
class CreatePasswordResetTokenTaskTest extends TestCase
{
    public function testCreatePasswordResetTask(): void
    {
        $user = User::factory()->create();

        app(CreatePasswordResetTokenTask::class)->run($user);

        $this->assertDatabaseHas('password_resets', [
            'email' => $user->email,
        ]);
    }
}

<?php

namespace App\Containers\AppSection\User\Tests\Unit;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\CreatePasswordResetTask;
use App\Containers\AppSection\User\Tests\TestCase;

/**
 * Class CreatePasswordResetTaskTest.
 *
 * @group user
 * @group unit
 */
class CreatePasswordResetTaskTest extends TestCase
{
    public function testCreatePasswordResetTask(): void
    {
        $user = User::factory()->create();

        app(CreatePasswordResetTask::class)->run($user);

        $this->assertDatabaseHas('password_resets', [
            'email' => $user->email,
        ]);
    }
}

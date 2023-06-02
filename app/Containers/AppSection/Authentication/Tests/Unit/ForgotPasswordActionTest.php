<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use App\Containers\AppSection\Authentication\Actions\ForgotPasswordAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\ForgotPasswordRequest;
use Illuminate\Support\Facades\Mail;

/**
 * @group authentication
 * @group unit
 */
class ForgotPasswordActionTest extends UnitTestCase
{
    public function testIfUserExists_ShouldReturnTrue(): void
    {
        $user = $this->getTestingUser();
        $data = [
            'email' => $user->email,
            'reseturl' => 'http://localhost'
        ];

        $request = new ForgotPasswordRequest($data);
        $result = app(ForgotPasswordAction::class)->run($request);

        $this->assertTrue($result);
    }

    public function testIfUserNotExists_ShouldTrue(): void
    {
        $data = [
            'email' => 'wrong@mail.test',
        ];

        $request = new ForgotPasswordRequest($data);
        $result = app(ForgotPasswordAction::class)->run($request);

        $this->assertTrue($result);
    }
}

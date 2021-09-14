<?php

namespace App\Containers\AppSection\User\Tests\Unit;

use App\Containers\AppSection\User\Actions\ForgotPasswordAction;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\TestCase;
use App\Containers\AppSection\User\UI\API\Requests\ForgotPasswordRequest;
use App\Ship\Exceptions\NotFoundException;

/**
 * Class ForgotPasswordActionTest.
 *
 * @group user
 * @group unit
 */
class ForgotPasswordActionTest extends TestCase
{
    public function testIfUserNotExists_ShouldNotReturn404(): void
    {
        $data = [
            'email' => 'wrong@mail.test',
        ];

        $request = new ForgotPasswordRequest($data);
        $result = app(ForgotPasswordAction::class)->run($request);

        $this->assertFalse($result);
    }

    public function testIfEndpointIsNotAllowed_ShouldReturn404(): void
    {
        $user = User::factory()->create();
        $data = [
            'email' => $user->email,
            'reseturl' => 'some_illegal_url',
        ];
        
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage("The URL is not allowed ({$data['reseturl']})");


        $request = new ForgotPasswordRequest($data);
        app(ForgotPasswordAction::class)->run($request);
    }
}

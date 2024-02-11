<?php

namespace App\Containers\AppSection\User\Tests\Unit\Actions;

use App\Containers\AppSection\User\Actions\UpdateUserAction;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Data\Resources\UserResource;
use App\Containers\AppSection\User\Enums\Gender;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
#[CoversClass(UpdateUserAction::class)]
final class UpdateUserActionTest extends UnitTestCase
{
    public function testCanUpdateUser(): void
    {
        $user = UserFactory::new()
            ->gender(Gender::FEMALE)
            ->createOne(['password' => 'youShallNotPass']);
        $data = [
            'id' => $user->id,
            'name' => 'a name',
            'gender' => Gender::MALE->value,
            'birth' => Carbon::today()->toIso8601String(),
            'password' => 'test',
        ];
        $userData = UserResource::from($data);
        $action = app(UpdateUserAction::class);

        $result = $action->run($userData);

        $this->assertSame($data['name'], $result->name);
        $this->assertSame(Gender::from($data['gender']), $result->gender);
        $this->assertTrue($result->birth->isSameDay($data['birth']));
        $this->assertTrue(Hash::check($data['password'], $result->password));
    }
}

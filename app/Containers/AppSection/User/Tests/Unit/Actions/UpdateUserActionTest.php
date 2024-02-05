<?php

namespace App\Containers\AppSection\User\Tests\Unit\Actions;

use App\Containers\AppSection\User\Actions\UpdateUserAction;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Enums\Gender;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Containers\AppSection\User\UI\API\Requests\UpdateUserRequest;
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
            'name' => 'a name',
            'gender' => Gender::MALE->value,
            'birth' => Carbon::today(),
            'password' => 'test',
        ];
        $request = UpdateUserRequest::injectData($data, $user)->withUrlParameters(['id' => $user->id]);
        $action = app(UpdateUserAction::class);

        $result = $action->run($request);

        $this->assertSame($data['name'], $result->name);
        $this->assertSame(Gender::from($data['gender']), $result->gender);
        $this->assertTrue($result->birth->isSameDay($data['birth']));
        $this->assertFalse(Hash::check($data['password'], $result->password));
    }
}

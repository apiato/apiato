<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Unit\Actions;

use App\Containers\AppSection\User\Actions\UpdateUserAction;
use App\Containers\AppSection\User\Enums\Gender;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(UpdateUserAction::class)]
final class UpdateUserActionTest extends UnitTestCase
{
    public function testCanUpdateUser(): void
    {
        $user = User::factory()
            ->gender(Gender::FEMALE)
            ->createOne(['password' => 'youShallNotPass']);
        $data = [
            'name'     => 'a name',
            'gender'   => Gender::MALE->value,
            'birth'    => Date::today()->toIso8601String(),
            'password' => 'test',
        ];
        $action = app(UpdateUserAction::class);

        $result = $action->run($user->id, $data);

        self::assertSame($data['name'], $result->name);
        self::assertSame(Gender::from($data['gender']), $result->gender);
        self::assertTrue($result->birth->isSameDay($data['birth']));
        self::assertTrue(Hash::check($data['password'], $result->password));
    }
}

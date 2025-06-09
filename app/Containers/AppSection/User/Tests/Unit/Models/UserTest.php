<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Unit\Models;

use App\Containers\AppSection\User\Enums\Gender;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(User::class)]
final class UserTest extends UnitTestCase
{
    public function testUsesCorrectTable(): void
    {
        $user = User::factory()->createOne();
        $table = 'users';

        self::assertSame($table, $user->getTable());
    }

    public function testHasCorrectFillableFields(): void
    {
        $user = User::factory()->createOne();
        $fillable = [
            'name',
            'email',
            'password',
            'gender',
            'birth',
        ];

        self::assertSame($fillable, $user->getFillable());
    }

    public function testHasCorrectCasts(): void
    {
        $user = User::factory()->createOne();
        $casts = [
            'id'                => 'int',
            'email_verified_at' => 'immutable_datetime',
            'password'          => 'hashed',
            'gender'            => Gender::class,
            'birth'             => 'immutable_date',
        ];

        self::assertSame($casts, $user->getCasts());
    }

    public function testHasCorrectHiddenFields(): void
    {
        $user = User::factory()->createOne();
        $hiddens = [
            'password',
            'remember_token',
        ];

        self::assertSame($hiddens, $user->getHidden());
    }

    public function testHasCorrectResourceKey(): void
    {
        $user = User::factory()->createOne();

        self::assertSame('User', $user->getResourceKey());
    }

    public function testCanAuthenticateUsingEmail(): void
    {
        $user = User::factory()->createOne();

        $result = (new User())->findForPassport($user->email);

        self::assertTrue($user->is($result));
    }

    public function testLowerCasesEmailOnAccess(): void
    {
        $original = 'GanDalf@thE.Gray';
        $expectedGet = 'gandalf@the.gray';
        $expectedSet = 'GanDalf@thE.Gray';
        $user = User::factory()->createOne(['email' => $original]);

        self::assertSame($expectedGet, $user->email);
        self::assertSame($expectedSet, DB::query()->from('users')->find($user->id)->email);
    }

    public function testIsSuperAdmin(): void
    {
        $user = User::factory()->createOne();

        self::assertFalse($user->isSuperAdmin());

        $user = User::factory()->superAdmin()->createOne();

        self::assertTrue($user->isSuperAdmin());
    }
}

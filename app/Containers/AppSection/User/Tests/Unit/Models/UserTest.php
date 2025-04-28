<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Unit\Models;

use App\Containers\AppSection\Authentication\Notifications\VerifyEmail;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Enums\Gender;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(User::class)]
final class UserTest extends UnitTestCase
{
    public function testUsesCorrectTable(): void
    {
        $model = UserFactory::new()->createOne();
        $table = 'users';

        $this->assertSame($table, $model->getTable());
    }

    public function testHasCorrectFillableFields(): void
    {
        $model = UserFactory::new()->createOne();
        $fillables = [
            'name',
            'email',
            'password',
            'gender',
            'birth',
        ];

        $this->assertSame($fillables, $model->getFillable());
    }

    public function testHasCorrectCasts(): void
    {
        $model = UserFactory::new()->createOne();
        $casts = [
            'id'                => 'int',
            'email_verified_at' => 'immutable_datetime',
            'password'          => 'hashed',
            'gender'            => Gender::class,
            'birth'             => 'immutable_date',
        ];

        $this->assertSame($casts, $model->getCasts());
    }

    public function testHasCorrectHiddenFields(): void
    {
        $model = UserFactory::new()->createOne();
        $hiddens = [
            'password',
            'remember_token',
        ];

        $this->assertSame($hiddens, $model->getHidden());
    }

    public function testHasCorrectResourceKey(): void
    {
        $model = UserFactory::new()->createOne();

        $this->assertSame('User', $model->getResourceKey());
    }

    public function testSendEmailVerificationNotificationWithVerificationUrl(): void
    {
        Notification::fake();
        $model = UserFactory::new()->createOne();

        $model->sendEmailVerificationNotificationWithVerificationUrl('http://localhost');

        Notification::assertSentTo($model, VerifyEmail::class);
    }

    public function testGetHashedEmailForVerification(): void
    {
        $model = UserFactory::new()->createOne();

        $hashedEmail = $model->getHashedEmailForVerification();

        $this->assertSame(sha1((string) $model->getEmailForVerification()), $hashedEmail);
    }

    public function testUsesEmailFieldAsDefaultLoginFieldFallback(): void
    {
        config()->unset('appSection-authentication.login.fields');
        $model = UserFactory::new()->createOne();

        $result = (new User())->findForPassport($model->email);

        $this->assertTrue($model->is($result));
    }

    public function testCanAuthenticateUsingAllowedLoginFields(): void
    {
        config()->set('appSection-authentication.login.fields', ['name' => []]);
        $model = UserFactory::new()->createOne();

        $result = (new User())->findForPassport($model->name);

        $this->assertTrue($model->is($result));
    }

    public function testLowerCasesEmailOnAccess(): void
    {
        $original = 'GanDalf@thE.Gray';
        $expectedGet = 'gandalf@the.gray';
        $expectedSet = 'GanDalf@thE.Gray';
        $model = UserFactory::new()->createOne(['email' => $original]);

        $this->assertSame($expectedGet, $model->email);
        $this->assertSame($expectedSet, DB::query()->from('users')->find($model->id)->email);
    }
}

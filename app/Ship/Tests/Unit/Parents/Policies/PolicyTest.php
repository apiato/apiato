<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Parents\Policies;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Policies\Policy;
use App\Ship\Parents\Providers\MainServiceProvider;
use App\Ship\Parents\Requests\Request;
use App\Ship\Tests\ShipTestCase;
use Illuminate\Contracts\Auth\Access\Gate;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Policy::class)]
final class PolicyTest extends ShipTestCase
{
    public function testAdminCanBypassAllAuthorizations(): void
    {
        $this->getTestingUser(createUserAsAdmin: true);

        $fakeRequest = FakeRequest::injectData([], $this->testingUser);

        $this->assertTrue($fakeRequest->authorize(app(Gate::class)));
    }

    public function testNonAdminCannotBypassAllAuthorizations(): void
    {
        $this->getTestingUser();

        $fakeRequest = FakeRequest::injectData([], $this->testingUser);

        $this->assertFalse($fakeRequest->authorize(app(Gate::class)));
    }

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->register(FakeServiceProvider::class);
    }
}

class FakeUserPolicy extends Policy
{
    public function access(User $user): bool
    {
        return false;
    }
}

class FakeRequest extends Request
{
    public function authorize(Gate $gate): bool
    {
        return $gate->allows('access', FakeUser::class);
    }
}

class FakeUser extends User
{
}

class FakeServiceProvider extends MainServiceProvider
{
    protected array $policies = [
        FakeUser::class => FakeUserPolicy::class,
    ];
}

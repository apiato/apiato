<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional\API\EmailVerification;

use App\Containers\AppSection\Authentication\Actions\EmailVerification\GenerateUrlAction;
use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\EmailVerification\VerifyController;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(VerifyController::class)]
final class VerifyTest extends ApiTestCase
{
    public function testVerifyEmail(): void
    {
        $this->freezeTime();
        Event::fake();
        $user = User::factory()->unverified()->createOne();
        $this->actingAs($user, 'api');
        $url = (new GenerateUrlAction())($user);
        $request = Request::create(Str::of(Request::create($url)->decodedPath())->after('verification_url=')->value());

        $response = $this->postJson(
            action(VerifyController::class, [
                'id' => $user->getHashedKey(),
                'hash' => sha1($user->getEmailForVerification()),
                'expires' => $request->query('expires'),
                'signature' => $request->query('signature'),
            ]),
        );

        $response->assertOk();
        Event::assertDispatched(Verified::class, static function (Verified $event) use ($user) {
            return $event->user->is($user);
        });
    }
}

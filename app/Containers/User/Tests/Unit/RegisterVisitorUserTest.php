<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\APIAuthentication\Middlewares\VisitorsAuthentication;
use App\Port\Tests\PHPUnit\Abstracts\TestCase;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

/**
 * Class RegisterVisitorUserTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterVisitorUserTest extends TestCase
{

    public function testRegisterVisitorAutomatically()
    {
        $visitorId = str_random(40);

        $request = App::make(Request::class);
        $request->headers->set('Visitor-Id', $visitorId);

        $middleware = App::make(VisitorsAuthentication::class);

        $middleware->handle($request, function ($r) {});

        // assert a visitor was created in the DB
        $this->seeInDatabase('users', ['visitor_id' => $visitorId]);
    }

    public function testNotRegisteringVisitorWhenTokenExist()
    {
        $token = str_random(60);

        $request = App::make(Request::class);
        $request->headers->set('Authorization', $token);

        $middleware = App::make(VisitorsAuthentication::class);

        $middleware->handle($request, function ($r) {});

        // assert a visitor was created in the DB
        $usersTotal = User::all()->count();
        $this->assertEquals(1, $usersTotal); // 1 is the default seeded Super Admin
        $this->notSeeInDatabase('users', ['id' => 2]);
    }

}

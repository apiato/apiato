<?php

namespace App\Containers\Authentication\UI\WEB\Tests\Functional;

use App\Ship\Parents\Tests\PhpUnit\TestCase;
use App\Ship\Parents\Tests\PhpUnit\WebTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

/**
 * Class UserLoginTest
 *
 * @author  Johan Alvarez <llstarscreamll@hotmail.com>
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ProtectedDashboardPage extends TestCase
{
    //use WithoutMiddleware;

    // overrides the default subDomain in the base URL
    protected $subDomain = 'admin';
    protected $endpoint = '/dashboard';

    public function testProtectedDashboardRoute()
    {
        // go to the protected page, without login
        $response = $this->get($this->endpoint);

        // should be redirected to login page
        $response->assertResponseStatus(302);
        $this->assertRedirectedTo('login');
        $this->see('login');
    }
}

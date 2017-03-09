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
class UserLogoutTest extends TestCase
{
    use WithoutMiddleware;

    // overrides the default subDomain in the base URL
    protected $subDomain = 'admin';
    protected $endpoint = '/logout';

    public function testUserLogout()
    {
        // go to the page
        $this->visit('login')
            ->see('Login');

        // fill the login form
        $this->type('admin@admin.com', 'email')
            ->type('admin', 'password')
            ->press('login');

        // login success and redirect to welcome view
        $this->seePageIs('/dashboard')
            ->see('Hello Admin');

        // trigger the logout request
        $response = $this->post($this->endpoint);

        $response->assertResponseStatus(302);
        $this->assertRedirectedTo('login');
        $this->see('login');
    }
}

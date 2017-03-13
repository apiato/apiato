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
    // overrides the default subDomain in the base URL
    protected $subDomain = 'admin';
    protected $endpoint = '/logout';

    public function setUp()
    {
        // we change the API_PREFIX for web routes to make available all the
        // right web behavior. Maybe this should be seted up on
        // TestCaseTrait->overrideSubDomain() method?
        putenv("API_PREFIX=api");

        parent::setUp();
    }

    public function tearDown()
    {
        // revert the API_PREFIX variable to null to avoid effects on other test
        putenv("API_PREFIX=");
        parent::tearDown();
    }

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

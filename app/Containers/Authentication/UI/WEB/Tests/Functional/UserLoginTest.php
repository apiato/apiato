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
class UserLoginTest extends TestCase
{
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

    // overrides the default subDomain in the base URL
    protected $subDomain = 'admin';
    protected $endpoint = '/login';

    public function testUserLogin_()
    {
        // go to the page
        $this->visit($this->endpoint)
            ->seePageIs($this->endpoint)
            ->see('Login');

        // fill the login form
        $this->type('admin@admin.com', 'email')
            ->type('admin', 'password')
            ->press('login');

        // login success and redirect to welcome view
        $this->seePageIs('/dashboard')
            ->see('Hello Admin');
    }

    public function testLoginWithInvalidCredentials()
    {
        // go to the page
        $this->visit($this->endpoint)
            ->seePageIs($this->endpoint)
            ->see('Login');

        // fill the login form with wrong credentials
        $this->type('foo@foo.com', 'email')
            ->type('foo.123', 'password')
            ->press('login');

        // we are redirected to the login page and we see errors
        $this->seePageIs($this->endpoint)
            ->see('Credentials Incorrect.');
    }

    public function checkValidationMessages()
    {
        // go to the page
        $this->visit($this->endpoint)
            ->seePageIs($this->endpoint)
            ->see('Login');

        // fill the login form with wrong credentials
        $this->type('', 'email')
            ->type('', 'password')
            ->press('login');
        
        // we are redirected to the login page and we see validation errors
        $this->seePageIs($this->endpoint)
            ->see('email field is required.')
            ->see('password field is required.');
    }
}

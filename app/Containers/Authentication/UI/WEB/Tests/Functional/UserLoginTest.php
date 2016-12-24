<?php

namespace App\Containers\Authentication\UI\WEB\Tests\Functional;

use App\Port\Tests\PHPUnit\Abstracts\WebTestCase;
use Faker\Generator;
// use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Contracts\Console\Kernel as LaravelPort;
use Illuminate\Foundation\Testing\WithoutMiddleware;

/**
* Class UserLoginTest.
*
* @author  Johan Alvarez <llstarscreamll@hotmail.com>
*/
class UserLoginTest extends WebTestCase
{
    use WithoutMiddleware;
    
    private $endpoint = '/login';

    public function testUserLogin()
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

        // fill the login form
        $this->type('foo@foo.com', 'email')
            ->type('foo.123', 'password')
            ->press('login');

        // we are redirected to the login page and see errors
        $this->seePageIs($this->endpoint)
            ->see('Credentials Incorrect.');
    }
}

<?php
//
//namespace App\Containers\Authentication\UI\WEB\Tests\Functional;
//
//use App\Containers\Authentication\Tests\WebTestCase;
//
///**
// * Class UserLoginTest
// *
// * @author  Johan Alvarez <llstarscreamll@hotmail.com>
// * @author  Mahmoud Zalt  <mahmoud@zalt.me>
// */
//class UserLoginTest extends WebTestCase
//{
//    protected $endpoint = '/login';
//
//    public function testWebUserLogin_()
//    {
//        // go to the page
//        $browser->visit()
//            ->assertPathIs($this->endpoint)
//            ;
//
//        // fill the login form
//        $this->type('admin@admin.com', 'email')
//            ->type('admin', 'password')
//            ->press('login');
//
//        // login success and redirect to welcome view
//        $this->assertPathIs('/dashboard')
//            ->see('Apiato Admin');
//    }
//
//    public function testWebUserLoginWithInvalidCredentials()
//    {
//        // go to the page
//        $this->visit($this->endpoint)
//            ->seePageIs($this->endpoint)
//            ->see('Login');
//
//        // fill the login form with wrong credentials
//        $this->type('foo@foo.com', 'email')
//            ->type('foo.123', 'password')
//            ->press('login');
//
//        // we are redirected to the login page and we see errors
//        $this->seePageIs($this->endpoint)
//            ->see('Credentials Incorrect.');
//    }
//
//    public function testValidationIsWorking()
//    {
//        // go to the page
//        $this->visit($this->endpoint)
//            ->seePageIs($this->endpoint)
//            ->see('Login');
//
//        // fill the login form with wrong credentials
//        $this->type('', 'email')
//            ->type('', 'password')
//            ->press('login');
//
//        // we are redirected to the login page and we see validation errors
//        $this->seePageIs($this->endpoint)
//            ->see('email field is required.')
//            ->see('password field is required.');
//    }
//}

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
//class UserLogoutTest extends WebTestCase
//{
//    protected $endpoint = '/logout';
//
//    public function testWebUserLogout()
//    {
//        // go to the page
//        $this->visit('login')
//            ->see('Login');
//
//        // fill the login form
//        $this->type('admin@admin.com', 'email')
//            ->type('admin', 'password')
//            ->press('login');
//
//        // login success and redirect to welcome view
//        $this->seePageIs('/dashboard')
//            ->see('Apiato Admin');
//
//        // trigger the logout request
//        $response = $this->post($this->endpoint);
//
//        $response->assertResponseStatus(302);
//        $this->assertRedirectedTo('login');
//        $this->see('login');
//    }
//}

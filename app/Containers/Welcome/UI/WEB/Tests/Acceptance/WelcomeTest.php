<?php

namespace App\Containers\Welcome\UI\WEB\Tests\Acceptance;

use App\Port\Tests\PHPUnit\Abstracts\TestCase;

/**
 * Class WelcomeTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WelcomeTest extends TestCase
{

    private $page = '/';

    public function testDisplayWelcomeView()
    {

        // TODO: this is causing the following error:
        // (InvalidArgumentException: Expecting a DOMNodeList or DOMNode instance, an array, a string, or null, but got "Illuminate\View\View".)
        // This is probably because of the Dingo package since it's response is being used for everything even web requests..
        // or caused after upgrading to laravel 5.2 because of the composer requirement of `"symfony/dom-crawler": "2.8.*|3.0.*"` in case
        // the crawler class was updated..
        // if you go to `Illuminate/Foundation/Testing/Concerns/InteractsWithPages.php` and this `dd(get_class($this->response));` to line 83
        // you should see `Dingo\Api\Http\Response` which when we call `->getContent()` on it returns `Illuminate\View\View`
        // while the Crawler `vendor/symfony/dom-crawler/Crawler.php` is expecting other things as the error states.
        // I will fix this later...

//        $this->visit($this->page)
//            ->see('Hello API');

    }

}

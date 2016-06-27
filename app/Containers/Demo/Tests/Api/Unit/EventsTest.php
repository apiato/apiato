<?php

namespace App\Containers\SteamAuth\Tests\Api\Unit;

use App\Containers\Demo\Events\Events\DemoEvent;
use App\Kernel\Tests\PHPUnit\Abstracts\TestCase;
use Illuminate\Support\Facades\Event;

/**
 * Class EventsTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class EventsTest extends TestCase
{

    public function testDemoEvent_()
    {
        Event::fire(New DemoEvent());
    }


}

<?php

namespace App\Services\Tests;

use App\Kernel\Tests\PHPUnit\Abstracts\TestCase;
use App\Services\Mails\Portals\MailsService;
use Illuminate\Support\Facades\App;

/**
 * Class SendEmailTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SendEmailTest extends TestCase
{

    public function testSendingEmail_()
    {

        // TODO:to be mocked
        $service = App::make(MailsService::class);

        $service->send();
    }
}

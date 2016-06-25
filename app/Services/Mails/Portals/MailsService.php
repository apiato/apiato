<?php

namespace App\Services\Mails\Portals;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

/**
 * Class MailsService.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class MailsService
{

    public function __construct()
    {
        // instruct laravel to look for views in this directory
        View::addLocation('app/Services/Mails/Views');
    }

    public function send($data = [])
    {
        // TODO: this is just a dumy sample for testing
        Mail::send('sampler', $data, function ($m) {
            $m->from('test@test.test', 'Hello API');
            $m->to('testing@testing.testing', 'Mahmoud Zalt')->subject('Testing From Hello API :)');
        });
    }

}

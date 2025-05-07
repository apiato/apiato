<?php

namespace App\Ship\Parents\Mails;

use Apiato\Core\Mails\Mail as AbstractMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

abstract class Mail extends AbstractMail
{
    use Queueable;
    use SerializesModels;
}

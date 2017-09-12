<?php

namespace App\Ship\Parents\Mails;

use Apiato\Core\Abstracts\Mails\Mail as AbstractMail;
use Illuminate\Queue\SerializesModels;

/**
 * Class Mail.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Mail extends AbstractMail
{
    use SerializesModels;
}

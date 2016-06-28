<?php

namespace App\Services\Mails\Mails;

use App\Services\Mails\Abstracts\MailsAbstract;
use App\Services\Mails\Contracts\MailsInterface;

/**
 * Class ConfirmEmail.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ConfirmEmail extends MailsAbstract implements MailsInterface
{

    /**
     * The email template name. (a view file name form "app/Services/Mails/Views/")
     *
     * @var  string
     */
    public $template = 'confirm';

    /**
     * The email subject
     *
     * @var  string
     */
    public $subject = 'Email confirmation (Hello API)';
}

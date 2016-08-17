<?php

namespace App\Containers\Email\Mails;

use App\Port\Email\Abstracts\MailsAbstract;
use App\Port\Email\Contracts\MailsInterface;

/**
 * Class ConfirmEmail.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ConfirmEmail extends MailsAbstract implements MailsInterface
{

    /**
     * The email template name. (a view file name form "app/Tasks/Mails/Views/")
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

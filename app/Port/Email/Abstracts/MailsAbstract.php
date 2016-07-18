<?php

namespace App\Port\Email\Abstracts;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

/**
 * Class MailsAbstract.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class MailsAbstract
{

    /**
     * @var string
     */
    public $fromEmail;

    /**
     * @var string
     */
    public $fromName;

    /**
     * @var string
     */
    protected $toEmail;

    /**
     * @var string
     */
    protected $toName;

    /**
     * MailsAbstract constructor.
     *
     * @param \Illuminate\Mail\Mailer $mail
     */
    public function __construct()
    {
        $this->fromEmail = config('mail.from.address');
        $this->fromName = config('mail.from.name');
    }

    /**
     * Send the email
     *
     * @param array $data
     */
    public function send($data = [])
    {
        // get if sending emails is enabled
        $enabled = Config::get('mail.enabled');

        // check if sending emails is enabled and if this is not running a testing environment
        if ($enabled && app()->env != 'testing') {
            Mail::queue('EmailTemplates.' . $this->template, $data, function ($m) {
                $m->from($this->fromEmail, $this->fromName);
                $m->to($this->toEmail, $this->toName)
                    ->subject($this->subject);
            });
        }
    }


    /**
     * @param  mixed $toEmail
     */
    public function setEmail($toEmail)
    {
        $this->toEmail = $toEmail;
    }

    /**
     * @param  mixed $toName
     */
    public function setName($toName)
    {
        $this->toName = $toName;
    }


}

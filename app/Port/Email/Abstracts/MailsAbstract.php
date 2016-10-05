<?php

namespace App\Port\Email\Abstracts;

use App\Port\Exception\Exceptions\EmailIsMissedException;
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
     * @var string
     */
    protected $subject;

    /**
     * MailsAbstract constructor.
     *
     * @param \Illuminate\Mail\Mailer $mail
     */
    public function __construct()
    {
        // set default values from the config for both emails directions
        // you can override everything later when using it.
        $this->from(config('mail.from.address'), config('mail.from.name'));
        $this->to(config('mail.to.address'), config('mail.to.name'));
    }

    /**
     * Send the email
     *
     * @param array $data
     *
     * @return  bool
     */
    public function send($data = [])
    {
        if(!$this->fromEmail || !$this->toEmail){
            throw new EmailIsMissedException();
        }

        // TODO: surround with try and catch block and return exception

        // check if sending emails is enabled and if this is not running a testing environment
        if (Config::get('mail.enabled')) {

            Mail::queue('EmailTemplates.' . $this->template, $data, function ($m) {
                $m->from($this->fromEmail, $this->fromName);
                $m->to($this->toEmail, $this->toName)
                    ->subject($this->subject);
            });
        }

        return true;
    }

    /**
     * @param $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @param        $email
     * @param string $name
     *
     * @return  $this
     */
    public function to($email, $name = '')
    {
        $this->toEmail = $email;
        $this->toName = $name;

        return $this;
    }

    /**
     * @param        $email
     * @param string $name
     *
     * @return  $this
     */
    public function from($email, $name = '')
    {
        $this->fromEmail = $email;
        $this->fromName = $name;

        return $this;
    }

}

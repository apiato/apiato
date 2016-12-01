<?php

namespace App\Containers\Contact\Tasks;

use App\Containers\Contact\Mails\ContactUsEmail;
use App\Port\Task\Abstracts\Task;

/**
 * Class SendContactUsEmailTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SendContactUsEmailTask extends Task
{

    /**
     * @var  \App\Containers\Contact\Mails\ContactUsEmail
     */
    private $email;

    /**
     * SampleAction constructor.
     *
     * @param \App\Containers\Contact\Mails\ContactUsEmail $contactUsEmail
     */
    public function __construct(ContactUsEmail $contactUsEmail)
    {
        $this->email = $contactUsEmail;
    }

    /**
     * @param        $fromEmail
     * @param        $message
     * @param string $subject
     * @param string $fromName
     *
     * @return  bool
     */
    public function run($fromEmail, $message, $subject = 'No Subject', $fromName = 'No Name')
    {
        $this->email->to(env('MAIL_TO_SUPPORT_ADDRESS'));
        $this->email->setSubject($subject);
        $result = $this->email->send([
            'email'   => $fromEmail,
            'name'    => $fromName,
            'content' => $message,
        ]);

        return $result;
    }
}

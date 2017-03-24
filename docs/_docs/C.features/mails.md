---

title: "Mails"

category: "Features"

---

There are 2 types of emails directions supported:

- A: Emails from App to User (Example: Registration Welcome Email)

- B: Emails from User to App (Example: Contact Us Email)

#### Email Setup *(one time only)*

.1. Go to `.env` and edit all the `MAIL_*` variables.

.2. Go to `config/mail.php` and set the `from` and `to` variables. (`from` is used when sending emails from App to User, and `to` is used when sending emails from User to App).

#### A: sending email **from App to User**

In the cases where you need to send emails to the App to the Users (example: Welcome Email or Email verification..).

.1. Create an Email class in this directory `app/Containers/Email/Mails/` like this:

	 <?php
	namespace App\Containers\Email\Mails;
	
	use App\Port\Email\Abstracts\MailsAbstract;
	use App\Port\Email\Contracts\MailsInterface;
	
	class WelcomeEmail extends MailsAbstract implements MailsInterface
	{
	    public $template = 'welcome';
	
	    public $subject = 'Welcome to apiato';
	}
	 
Note: all your Email classes must extend from `App\Port\Email\Abstracts\MailsAbstract` and implement `App\Port\Email\Contracts\MailsInterface`.

.2. Create an email HTML template in the Container's email Templates `app/Containers/Email/UI/WEB/Views/EmailTemplates` (`welcome.blade.php`)

	 <!DOCTYPE html>
	<html lang="en-US">
	<head>
	    <meta charset="utf-8">
	</head>
	<body>
	<h3>Welcome { {$name} }</h3>
	<div>
	    Thank you for signing up with { {$appName} }.
	</div>
	</body>
	</html> 
Note: the template name should be placed in the `$template` variable on the Email class.

.3. call the email from anywhere (example of sending email from a queueable Event class)

	 <?php
	
	namespace App\Containers\User\Events\Handlers;
	
	use App\Containers\Email\Mails\WelcomeEmail;
	use App\Containers\User\Events\Events\UserCreatedEvent;
	use Illuminate\Contracts\Queue\ShouldQueue;
	
	/**
	 * Class UserCreatedEventHandler
	 *
	 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
	 */
	class UserCreatedEventHandler implements ShouldQueue
	{
	
	    /**
	     * @var  \App\Containers\Email\Mails\WelcomeEmail
	     */
	    private $welcomeEmail;
	
	    /**
	     * UserCreatedEventHandler constructor.
	     *
	     * @param \App\Containers\Email\Mails\WelcomeEmail $welcomeEmail
	     */
	    public function __construct(WelcomeEmail $welcomeEmail)
	    {
	        $this->welcomeEmail = $welcomeEmail;
	    }
	
	    /**
	     * @param \App\Containers\User\Events\Events\UserCreatedEvent $event
	     */
	    public function handle(UserCreatedEvent $event)
	    {
	        $this->welcomeEmail->to($event->user->email, $event->user->name)->send([
	            'name'    => $event->user->name,
	            'appName' => 'apiato'
	        ]);
	    }
	}
	 
Note: you must always inject the mail, to facilitate mocking the email sending service during testing.

#### B: sending email **from User to App**

In the cases where you need to send emails to the Users to the App (example: Contact Us, Report an Issue..).

.1. Create an Email class in this directory `app/Contact/Email/Mails/` like this:

	 <?php
	
	namespace App\Containers\Contact\Mails;
	
	use App\Port\Email\Abstracts\MailsAbstract;
	use App\Port\Email\Contracts\MailsInterface;
	
	/**
	 * Class WelcomeEmail.
	 *
	 * @author Mahmoud Zalt <mahmoud@zalt.me>
	 */
	class ContactUsEmail extends MailsAbstract implements MailsInterface
	{
	
	    /**
	     * The email template name.
	     *
	     * @var  string
	     */
	    public $template = 'contactUs';
	}
	 
.2. Create an email HTML template in the Container's email Templates `app/Contact/Email/UI/WEB/Views/EmailTemplates` (`contactUs.blade.php`)

	 <!DOCTYPE html>
	<html lang="en-US">
	<head>
	    <meta charset="utf-8">
	</head>
	<body>
	<h3>Support Request from: { {$name} }</h3>
	<div>
	    Message: { {$content} }
	</div>
	</body>
	</html> 
.3. call the email from anywhere (example of sending email from a Task class)

	 <?php
	
	namespace App\Containers\Contact\Tasks;
	
	use App\Containers\Contact\Mails\ContactUsEmail;
	use App\Containers\Contact\Services\ValidateConfirmationCodeService;
	use App\Containers\User\Services\FindUserByIdService;
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
	     * SendContactUsEmailTask constructor.
	     *
	     * @param \App\Containers\Contact\Mails\ContactUsEmail $contactUsEmail
	     */
	    public function __construct(ContactUsEmail $contactUsEmail)
	    {
	        $this->email = $contactUsEmail;
	    }
	
	    /**
	     * @param        $email
	     * @param        $message
	     * @param string $subject
	     * @param string $name
	     *
	     * @return  bool
	     */
	    public function run($fromEmail, $message, $subject = 'No Subject', $fromName = 'No Name')
	    {
	        $this->email->setSubject($subject);
	        $result = $this->email->from($fromEmail, $fromName)->send([
	            'name'    => $fromName,
	            'message' => $message,
	        ]);
	
	        return $result;
	    }
	}
	 
Note: you must always inject the mail, to facilitate mocking the email sending service during testing.

### Where to put the Email template?

It can be placed in any Container but it must follow the following folders structure `app/Contact/{ContainerName}/UI/WEB/Views/EmailTemplates/`

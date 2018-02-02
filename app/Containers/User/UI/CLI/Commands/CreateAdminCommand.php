<?php

namespace App\Containers\User\UI\CLI\Commands;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Commands\ConsoleCommand;
use App\Ship\Transporters\DataTransporter;

/**
 * Class CreateAdminCommand
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class CreateAdminCommand extends ConsoleCommand
{

    protected $signature = 'apiato:create:admin';

    protected $description = 'Create a new User with the ADMIN role';

    /**
     * @void
     */
    public function handle()
    {
        $username = $this->ask('Enter the username for this user');
        $email = $this->ask('Enter the email address of this user');
        $password = $this->secret('Enter the password for this user');
        $password_confirmation = $this->secret('Please confirm the password');

        if ($password != $password_confirmation) {
            $this->error('Passwords do not match - exiting!');
            return;
        }

        // ok, we have everything - lets create the user
        // we therefore simply create a Transporter
        $dataTransporter = new DataTransporter([
            'name' => $username,
            'email' => $email,
            'password' => $password,
        ]);

        // and then call respective Action
        $user = Apiato::call('User@CreateAdminAction', [$dataTransporter]);

        $this->info('Admin ' . $email . ' was successfully created');
    }
}

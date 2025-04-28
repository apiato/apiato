<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\UI\CLI\Commands;

use App\Containers\AppSection\User\Actions\CreateAdminAction;
use App\Ship\Parents\Commands\ConsoleCommand as ParentConsoleCommand;

class CreateAdminCommand extends ParentConsoleCommand
{
    protected $signature = 'apiato:create:admin';

    protected $description = 'Create a new User with the ADMIN role';

    public function handle(CreateAdminAction $action): void
    {
        $username = $this->ask('Enter the username for this user');
        $email = $this->ask('Enter the email address of this user');
        $password = $this->secret('Enter the password for this user');
        $password_confirmation = $this->secret('Please confirm the password');

        if ($password !== $password_confirmation) {
            $this->error('Passwords does not match - exiting!');

            return;
        }

        $data = [
            'name'     => $username,
            'email'    => $email,
            'password' => $password,
        ];

        try {
            $action->run($data);
        } catch (\Throwable $throwable) {
            $this->error($throwable->getMessage());

            return;
        }

        $this->info('Admin ' . $email . ' successfully created');
    }
}

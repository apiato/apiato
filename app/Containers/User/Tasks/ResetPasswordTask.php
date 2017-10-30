<?php

namespace App\Containers\User\Tasks;

use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class ResetPasswordTask extends Task
{

    public function __construct()
    {
        // ..
    }

    public function run($data)
    {
        try {
            Password::broker()->reset(
                $data,
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password),
                        'remember_token' => Str::random(60),
                    ])->save();
                }
            );
        } catch (Exception $e) {
            throw new ResourceNotFoundException();
        }
    }
}
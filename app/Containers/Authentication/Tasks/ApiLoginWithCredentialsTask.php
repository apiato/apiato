<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\Authentication\Adapters\JwtAuthAdapter;
use App\Containers\Authentication\Exceptions\AuthenticationFailedException;
use App\Containers\Authentication\Traits\AuthenticationTrait;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Http\Request;
use Exception;

/**
 * Class ApiLoginWithCredentialsTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiLoginWithCredentialsTask extends Task
{
    use AuthenticationTrait;
    /**
     * @var \App\Containers\Authentication\Adapters\JwtAuthAdapter
     */
    // private $jwtAuthAdapter;

    /**
     * ApiLoginWithCredentialsTask constructor.
     *
     * @param \App\Containers\Authentication\Adapters\JwtAuthAdapter $jwtAuthAdapter
     */
    // public function __construct(JwtAuthAdapter $jwtAuthAdapter)
    // {
    //     $this->jwtAuthAdapter = $jwtAuthAdapter;
    // }

    /**
     * @param $email
     * @param $password
     *
     * @return mixed
     */
    public function run(Request $request)
    {

        try {
            $user = $this->guard()->attempt(
                $this->credentials($request), $request->has('remember')
            );
            if (!$user) {
                throw new AuthenticationFailedException();
            }
            $token = $this->createToken()->accessToken;
            // dd($token);
        } catch (Exception $e) {
            // something went wrong whilst attempting to encode the token
            throw (new AuthenticationFailedException())->debug($e);
        }

        return $token;
    }

}

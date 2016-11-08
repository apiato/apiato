<?php

namespace App\Containers\Authentication\Traits;

use App\Containers\Authentication\Tasks\ApiGenerateTokenFromObjectTask;
use Illuminate\Support\Facades\App;

/**
 * Class TokenTrait.
 *
 * To be `used` by the `User` Model.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
trait TokenTrait
{

    /**
     * inject a token in the user model itself.
     * if no token provided generate token first.
     *
     * @param null $token
     *
     * @return $this
     */
    public function injectToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * When calling this function, the token will be added on the model.
     *
     * @return  $this
     */
    public function withToken()
    {
        return $this->injectToken(App::make(ApiGenerateTokenFromObjectTask::class)->run($this));
    }
}

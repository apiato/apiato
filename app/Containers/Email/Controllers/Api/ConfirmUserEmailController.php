<?php

namespace App\Containers\Email\Controllers\Api;

use App\Containers\Email\Exceptions\InvalidConfirmationCodeException;
use App\Containers\Email\Requests\ConfirmUserEmailRequest;
use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Containers\User\Exceptions\UserNotFoundException;
use App\Kernel\Controller\Abstracts\ApiController;
use Exception;
use Illuminate\Support\Facades\Cache;

/**
 * Class ConfirmUserEmailController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ConfirmUserEmailController extends ApiController
{

    /**
     * @var  \App\Containers\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {

        $this->userRepository = $userRepository;
    }

    /**
     * @param \App\Containers\Email\Requests\ConfirmUserEmailRequest $confirmUserEmailRequest
     *
     * @return  bool
     */
    public function handle(ConfirmUserEmailRequest $confirmUserEmailRequest)
    {
        try {
            // find the user by its id
            $user = $this->userRepository->find($confirmUserEmailRequest->id);
        } catch (Exception $e) {
            throw new UserNotFoundException;
        }

        // find the confirmation code of this user from the cache
        $codeFromCache = Cache::get('user:email-confirmation-code:' . $confirmUserEmailRequest->id);

        // if code is valid
        if (!$codeFromCache && $codeFromCache != $confirmUserEmailRequest->code) {
            throw new InvalidConfirmationCodeException;
        }

        // update user state
        $user->confirmed = true;
        $user->save();

        // remove the confirmation code from the cache
        Cache::forget('user:email-confirmation-code:' . $confirmUserEmailRequest->id);

        return true;
    }

}

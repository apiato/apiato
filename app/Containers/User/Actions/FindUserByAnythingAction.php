<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Services\FindUserService;
use App\Port\Action\Abstracts\Action;
use Illuminate\Support\Facades\Auth;

/**
 * Class FindUserByAnythingAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindUserByAnythingAction extends Action
{

    /**
     * @var  \App\Containers\User\Services\FindUserService
     */
    private $findUserService;

    /**
     * FindUserByAnythingAction constructor.
     *
     * @param \App\Containers\User\Services\FindUserService $findUserService
     */
    public function __construct(
        FindUserService $findUserService
    ) {
        $this->findUserService = $findUserService;
    }

    /**
     * @param $userId
     * @param $visitorId
     * @param $token
     *
     * @return  mixed
     */
    public function run($userId, $visitorId, $token)
    {
        if ($userId) {
            $user = $this->findUserService->byId($userId);
        } else {
            if ($token) {
                $user = Auth::user();
            } else {
                if ($visitorId) {
                    $user = $this->findUserService->byVisitorId($visitorId);
                }
            }
        }

        return $user;
    }

}

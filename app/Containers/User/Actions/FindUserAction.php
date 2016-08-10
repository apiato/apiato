<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Exceptions\UserNotFoundException;
use App\Containers\User\Services\FindUserService;
use App\Port\Action\Abstracts\Action;
use Exception;
use Illuminate\Support\Facades\Auth;

/**
 * Class FindUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindUserAction extends Action
{

    /**
     * @var  \App\Containers\User\Services\FindUserService
     */
    private $findUserService;

    /**
     * FindUserByIdAction constructor.
     *
     * @param \App\Containers\User\Services\FindUserService $findUserService
     */
    public function __construct(
        FindUserService $findUserService
    ) {
        $this->findUserService = $findUserService;
    }


    /**
     * @param $id
     *
     * @return  mixed
     */
    public function run($id)
    {
        try {
            $user = $this->findUserService->byId($id);
        } catch (Exception $e) {
            throw new UserNotFoundException;
        }

        return $user;
    }

    /**
     * @param $userId
     * @param $visitorId
     * @param $token
     *
     * @return  mixed
     */
    public function byEverything($userId, $visitorId, $token)
    {
        if($userId){
            $user = $this->findUserService->byId($userId);
        }else if($token){
            $user = Auth::user();
        }else if($visitorId){
            $user = $this->findUserService->byVisitorId($visitorId);
        }

        return $user;
    }



}

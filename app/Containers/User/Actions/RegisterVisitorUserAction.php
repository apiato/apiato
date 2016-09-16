<?php

namespace App\Containers\User\Actions;

use App\Containers\Authentication\Exceptions\AuthenticationFailedException;
use App\Containers\Authentication\Exceptions\MissingVisitorIdException;
use App\Port\Action\Abstracts\Action;
use Jenssegers\Agent\Agent;

/**
 * Class RegisterVisitorUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterVisitorUserAction extends Action
{

    /**
     * RegisterVisitorUserAction constructor.
     *
     * @param \Jenssegers\Agent\Agent                              $agent
     * @param \App\Containers\User\Actions\CreateVisitorUserAction $registerVisitorUserAction
     */
    public function __construct(
        Agent $agent,
        CreateVisitorUserAction $registerVisitorUserAction
    ) {
        $this->agent = $agent;
        $this->registerVisitorUserAction = $registerVisitorUserAction;
    }

    /**
     * @param      $visitorId
     * @param null $country
     *
     * @return  mixed
     */
    public function run($visitorId, $country = null)
    {
        if (!$visitorId) {
            throw new MissingVisitorIdException();
        }

        $device = $this->agent->device();
        $platform = $this->agent->platform();

        $user = $this->registerVisitorUserAction->run($visitorId, $device, $platform);

        if (!$user) {
            throw new AuthenticationFailedException(
                'Something went wrong while trying to create user from the "Visitor-Id": ' . $visitorId
            );
        }

        return $user;
    }
}

<?php

namespace App\Containers\SocialAuth\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\App;

/**
 * Class FindSocialUserTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindSocialUserTask extends Task
{
    /**
     * @param $socialProvider
     * @param $socialId
     *
     * @return  mixed
     */
    public function run($socialProvider, $socialId)
    {
        return App::make(UserRepository::class)->findWhere([
            'social_provider' => $socialProvider,
            'social_id'       => $socialId,
        ])->first();
    }

}

<?php

namespace App\Containers\Email\Tasks;

use App\Containers\Email\Exceptions\InvalidConfirmationCodeException;
use App\Port\Task\Abstracts\Task;
use Illuminate\Cache\Repository as Cache;

/**
 * Class ValidateConfirmationCodeTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ValidateConfirmationCodeTask extends Task
{

    /**
     * @var  \Illuminate\Cache\Repository
     */
    private $cache;

    /**
     * ValidateConfirmationCodeTask constructor.
     *
     * @param \Illuminate\Cache\Repository $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param $userId
     * @param $code
     *
     * @return  bool
     */
    public function run($userId, $code)
    {
        // find the confirmation code of this user from the cache
        $codeFromCache = $this->cache->get('user:email-confirmation-code:' . $userId);

        // if code is valid
        if (!$codeFromCache && $codeFromCache != $code) {
            throw new InvalidConfirmationCodeException;
        }

        // remove the confirmation code from the cache
        $this->cache->forget('user:email-confirmation-code:' . $userId);

        return true;
    }
}

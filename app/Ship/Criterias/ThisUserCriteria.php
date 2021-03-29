<?php

namespace App\Ship\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class ThisUserCriteria.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class ThisUserCriteria extends Criteria
{
    /**
     * @var int
     */
    private $userId;

    /**
     * ThisUserCriteria constructor.
     *
     * @param $userId
     */
    public function __construct($userId = null)
    {
        $this->userId = $userId;
    }

    /**
     * @param                                                   $model
     * @param PrettusRepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        if(!$this->userId){
            $this->userId = Auth::user()->id;
        }

        return $model->where('user_id', '=', $this->userId);
    }
}

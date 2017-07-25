<?php

namespace App\Containers\Settings\Data\Repositories;

use App\Containers\Settings\Models\Setting;
use App\Ship\Parents\Repositories\Repository;

/**
 * Class SettingsRepository
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class SettingRepository extends Repository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        'key' => '=',
    ];

    public function boot()
    {
        parent::boot();
        // probably do some stuff here ...
    }

    /**
     * @return  mixed
     */
    public function model()
    {
        return Setting::class;
    }
}

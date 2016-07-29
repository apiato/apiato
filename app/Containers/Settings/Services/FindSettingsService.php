<?php

namespace App\Containers\Settings\Services;

use App\Containers\Settings\Settings\Repositories\SettingsRepository;
use App\Port\Service\Abstracts\Service;

/**
 * Class FindSettingsService
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class FindSettingsService extends Service
{

    /**
     * @var  \App\Containers\Settings\Settings\Repositories\SettingsRepository
     */
    private $settingsRepository;

    /**
     * FindSettingsService constructor.
     *
     * @param \App\Containers\Settings\Settings\Repositories\SettingsRepository $settingsRepository
     */
    public function __construct(SettingsRepository $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
    }

    /**
     * @param $id
     *
     * @return  mixed
     */
    public function byKey($key)
    {
        $result = $this->settingsRepository->findWhere(['key' => $key])->first();

        return $result->value;
    }

    /**
     * @return  mixed
     */
    public function getReferringUserPoints()
    {
        return $this->byKey('referring_user_points');
    }

    /**
     * @return  mixed
     */
    public function getReferredUserPoints()
    {
        return $this->byKey('referred_user_points');
    }

}

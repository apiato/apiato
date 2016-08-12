<?php

namespace App\Containers\Settings\Services;

use App\Containers\Settings\Settings\Repositories\SettingsRepository;
use App\Port\Service\Abstracts\Service;

/**
 * Class UpdateSettingsService
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UpdateSettingsService extends Service
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
     * @param $key
     *
     * @return  mixed
     */
    private function findByKey($key)
    {
        $result = $this->settingsRepository->findWhere(['key' => $key])->first();

        return $result;
    }

    /**
     * @param $key
     * @param $value
     *
     * @return  mixed
     */
    public function update($key, $value)
    {
        $setting = $this->findByKey($key);

        $result = $this->settingsRepository->update([
            'value' => $value
        ], $setting->id);

        return $result;
    }

    /**
     * @param $points
     *
     * @return  mixed
     */
    public function updateReferringUserPoints($points)
    {
        return $this->update('referring_user_points', $points);
    }

    /**
     * @param $points
     *
     * @return  mixed
     */
    public function updateReferredUserPoints($points)
    {
        return $this->update('referred_user_points', $points);
    }

    /**
     * @param $points
     *
     * @return  mixed
     */
    public function updateOffersCacheTime($points)
    {
        return $this->update('offers_cache_time', $points);
    }

}

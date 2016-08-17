<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingsRepository;
use App\Port\Task\Abstracts\Task;

/**
 * Class UpdateSettingsTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UpdateSettingsTask extends Task
{

    /**
     * @var  \App\Containers\Settings\Data\Repositories\SettingsRepository
     */
    private $settingsRepository;

    /**
     * FindSettingsTask constructor.
     *
     * @param \App\Containers\Settings\Data\Repositories\SettingsRepository $settingsRepository
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
     * @param $value
     *
     * @return  mixed
     */
    public function updateSomething($value)
    {
        return $this->update('something', $value);
    }

}

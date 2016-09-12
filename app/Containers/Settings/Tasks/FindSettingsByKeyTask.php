<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingsRepository;
use App\Port\Task\Abstracts\Task;

/**
 * Class FindSettingsByKeyTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class FindSettingsByKeyTask extends Task
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
    public function run($key)
    {
        $result = $this->settingsRepository->findWhere(['key' => $key])->first();

        return $result->value;
    }

}

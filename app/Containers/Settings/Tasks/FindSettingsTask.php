<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingsRepository;
use App\Port\Task\Abstracts\Task;

/**
 * Class FindSettingsTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class FindSettingsTask extends Task
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
    public function getSomething()
    {
        return $this->byKey('something');
    }

}

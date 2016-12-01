<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingsRepository;
use App\Port\Task\Abstracts\Task;

/**
 * Class FindWhateverSettingsTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class FindWhateverSettingsTask extends Task
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
     * @return  mixed
     */
    public function run()
    {
        $settingsName = 'whatever';

        $result = $this->settingsRepository->findWhere(['key' => $settingsName])->first();

        return $result->value;
    }

}

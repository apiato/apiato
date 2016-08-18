<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingsRepository;
use App\Port\Task\Abstracts\Task;

/**
 * Class UpdateWhateverSettingsTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UpdateWhateverSettingsTask extends Task
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
     * @param $value
     *
     * @return  mixed
     */
    public function run($value)
    {
        $key = 'whatever';

        // TODO: replace both queries with a single UpdateWhere instead of find and update.
        //       this UpdateWhere will need to be added to the repository package (contribution).

        $setting = $this->settingsRepository->findWhere(['key' => $key])->first();

        $result = $this->settingsRepository->update([
            'value' => $value
        ], $setting->id);

        return $result;
    }

}

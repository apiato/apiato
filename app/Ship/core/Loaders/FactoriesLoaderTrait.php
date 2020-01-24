<?php

namespace Apiato\Core\Loaders;

use App;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factory;

/**
 * Class FactoriesLoaderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait FactoriesLoaderTrait
{

    /**
     * @param $containerName
     */
    public function loadFactoriesFromContainers($containerName)
    {
        $containerFactoriesDirectory = base_path('app/Containers/' . $containerName . '/Data/Factories');

        $this->loadFactoriesFrom($containerFactoriesDirectory);
    }
}

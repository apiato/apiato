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
     * By default Laravel takes a shared factory directory to load from it all the factories.
     * This function changes the path to load the factories from the port directory instead.
     */
    public function loadFactoriesFromContainers()
    {
        $loadersDirectory = str_replace(getcwd(), '', __DIR__);

        $newFactoriesPath = $loadersDirectory . '/FactoryMixer';

        App::singleton(Factory::class, function ($app) use ($newFactoriesPath) {
            $faker = $app->make(Generator::class);

            return Factory::construct($faker, base_path() . $newFactoriesPath);
        });
    }

}

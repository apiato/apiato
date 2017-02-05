<?php

namespace App\Port\Loader\Loaders;

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
     * By default Laravel takes (server/database/factories) as the
     * path to the factories, this function changes the path to load
     * the factories from the port directory.
     */
    public function changeTheDefaultFactoriesPath()
    {
        $newFactoriesPath = '/app/Port/Factory/Factories';

        App::singleton(Factory::class, function ($app) use ($newFactoriesPath) {
            $faker = $app->make(Generator::class);

            return Factory::construct($faker, base_path() . $newFactoriesPath);
        });
    }

}

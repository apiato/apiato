<?php

namespace App\Ship\Parents\Tests\PhpUnit;

use App;
use Artisan;
use Dingo\Api\Http\Response as DingoAPIResponse;

/**
 * Class TestCaseTrait
 *
 * Contains only functions needed by the main Test Case.
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
trait TestCaseTrait
{

    /**
     * Migrate the database.
     */
    public function migrateDatabase()
    {
        Artisan::call('migrate');
    }

    /**
     * override default URL subDomain in case you want to change it for some tests
     *
     * @param      $subDomain
     * @param null $url
     */
    public function overrideSubDomain($subDomain, $url = null)
    {
        $url = ($url) ? : $this->baseUrl;

        $info = parse_url($url);

        $array = explode('.', $info['host']);

        $withoutDomain = (array_key_exists(count($array) - 2,
                $array) ? $array[count($array) - 2] : '') . '.' . $array[count($array) - 1];

        $newSubDomain = $info['scheme'] . '://' . $subDomain . '.' . $withoutDomain;

        $this->baseUrl = $newSubDomain;
    }

}

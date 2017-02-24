<?php

namespace App\Ship\Parents\Tests\PhpUnit;

use Artisan;

/**
 * Class TestCaseTrait
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
     * Override default URL subDomain in case you want to change it for some tests
     *
     * @param null $url
     */
    public function overrideSubDomain($url = null)
    {
        // `subDomain` is a property defined in your class.
        if (!property_exists($this, 'subDomain')) {
            return;
        }

        $url = ($url) ? : $this->baseUrl;

        $info = parse_url($url);

        $array = explode('.', $info['host']);

        $withoutDomain = (array_key_exists(count($array) - 2,
                $array) ? $array[count($array) - 2] : '') . '.' . $array[count($array) - 1];

        $newSubDomain = $info['scheme'] . '://' . $this->subDomain . '.' . $withoutDomain;

        return $this->baseUrl = $newSubDomain;
    }

}

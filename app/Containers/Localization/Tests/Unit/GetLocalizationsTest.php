<?php

namespace App\Containers\Localization\Tests\Unit;

use App\Containers\Localization\Tasks\GetAllLocalizationsTask;
use App\Containers\Localization\Tests\TestCase;
use App\Containers\Localization\Values\Localization;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

/**
 * Class GetLocalizationsTest.
 *
 * @group localization
 * @group unit
 */
class GetLocalizationsTest extends TestCase
{

    /**
     * @test
     */
    public function test_if_all_supported_languages_are_returned()
    {
        $class = App::make(GetAllLocalizationsTask::class);
        $localizations = $class->run();

        $configuredLocalizations = Config::get('localization-container.supported_languages', []);

        // assert that they have the same amount of fields
        $this->assertEquals(count($configuredLocalizations), $localizations->count());

        // now we check all localizations in particular
    }

    public function test_if_specific_locale_is_returned()
    {
        $class = App::make(GetAllLocalizationsTask::class);
        $localizations = $class->run();

        $unsupportedLocale = new Localization('fr');

        $this->assertContainsEquals($unsupportedLocale, $localizations);
    }

    public function test_if_specific_locale_with_regions_is_returned()
    {
        $class = App::make(GetAllLocalizationsTask::class);
        $localizations = $class->run();

        $unsupportedLocale = new Localization('en', ['en-GB', 'en-US']);

        $this->assertContainsEquals($unsupportedLocale, $localizations);
    }

    public function test_if_wrong_locale_is_not_returned()
    {
        $class = App::make(GetAllLocalizationsTask::class);
        $localizations = $class->run();

        $unsupportedLocale = new Localization('xxx');

        $this->assertNotContainsEquals($unsupportedLocale, $localizations);
    }
}

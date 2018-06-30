<?php

namespace App\Containers\Localization\UI\WEB\Tests\Functional;

use Illuminate\Support\Facades\Config;
use App\Containers\Localization\Tests\TestCase;
use App\Containers\Localization\Exceptions\UnsupportedLanguageException;

/**
 * Class CheckLocalizationMiddlewareTest.
 *
 * @group localization
 * @group web
 */
class CheckWebLocalizationMiddlewareTest extends TestCase
{
    /**
     * @test
     */
    public function test_if_middleware_sets_default_app_language()
    {
        if (config('apiato.web.use_localized_routes')) {
            $this->markTestSkipped('Overridden route helper do not load before laravel helpers');
        }

        $requestHeaders = [];

        // send the HTTP request
        $response = $this->get(route('get_main_home_page'), $requestHeaders);

        // assert the response status
        $response->assertStatus(200);

        $defaultLanguage = Config::get('app.locale');

        // check if the header is properly set
        $response->assertHeader('content-language', $defaultLanguage);
    }

    public function test_if_middleware_sets_app_language_for_custom_request_header()
    {
        $language = 'fr';

        $requestHeaders = [];

        // send the HTTP request
        $response = $this->get(route('get_main_home_page', ['lang' => $language]), $requestHeaders);

        // assert the response status
        $response->assertStatus(200);

        // check if the header is properly set default language
        $response->assertHeader('content-language', $language);
    }

    public function test_if_middleware_throw_exception_for_unsupported_language()
    {
        $language = 'xx';

        $requestHeaders = [];

        // send the HTTP request
        $response = $this->get(route('get_main_home_page', ['lang' => $language]), $requestHeaders);

        $response->assertStatus(412);
        $this->assertInstanceOf(UnsupportedLanguageException::class, $response->exception);
    }
}

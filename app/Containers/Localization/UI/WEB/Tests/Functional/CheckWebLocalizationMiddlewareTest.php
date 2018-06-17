<?php

namespace App\Containers\Localization\UI\WEB\Tests\Functional;

use Illuminate\Support\Facades\Config;
use App\Containers\Localization\Tests\TestCase;

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
        $data = [];
        $requestHeaders = [];

        // send the HTTP request
        $response = $this->call('GET', Config::get('app.url'), $data, $requestHeaders);

        // assert the response status
        $response->assertStatus(200);

        $defaultLanguage = Config::get('app.locale');

        // check if the header is properly set
        $response->assertHeader('content-language', $defaultLanguage);
    }

    public function test_if_middleware_sets_custom_language()
    {
        $language = 'fr';

        $data = [];
        $requestHeaders = [
            'accept-language' => $language,
        ];

        // send the HTTP request
        $response = $this->call('GET', Config::get('app.url'), $data, $requestHeaders);

        // assert the response status
        $response->assertStatus(200);

        $defaultLanguage = Config::get('app.locale');

        // check if the header is properly set default language
        $response->assertHeader('content-language', $defaultLanguage);
    }
}

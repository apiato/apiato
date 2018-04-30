<?php

namespace App\Containers\Localization\UI\API\Tests\Functional;

use App\Containers\Localization\Tests\ApiTestCase;
use Illuminate\Support\Facades\Config;

/**
 * Class CheckLocalizationMiddlewareTest.
 *
 * @group localization
 * @group api
 */
class CheckLocalizationMiddlewareTest extends ApiTestCase
{

    // the endpoint to be called within this test (e.g., get@v1/users)
    protected $endpoint = 'get@v1/localizations';

    // fake some access rights
    protected $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    /**
     * @test
     */
    public function test_if_middleware_sets_default_app_language()
    {
        $data = [];
        $requestHeaders = [];

        // send the HTTP request
        $response = $this->makeCall($data, $requestHeaders);

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
        $response = $this->makeCall($data, $requestHeaders);

        // assert the response status
        $response->assertStatus(200);

        // check if the header is properly set
        $response->assertHeader('content-language', $language);
    }

    public function test_if_middleware_throws_error_on_wrong_language()
    {
        $language = 'xxx';

        $data = [];
        $requestHeaders = [
            'accept-language' => $language,
        ];

        // send the HTTP request
        $response = $this->makeCall($data, $requestHeaders);

        // assert the response status
        $response->assertStatus(412);
    }

}

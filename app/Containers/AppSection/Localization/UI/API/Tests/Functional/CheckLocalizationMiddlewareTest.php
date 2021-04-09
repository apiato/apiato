<?php

namespace App\Containers\AppSection\Localization\UI\API\Tests\Functional;

use App\Containers\AppSection\Localization\Tests\ApiTestCase;
use Illuminate\Support\Facades\Config;

/**
 * Class CheckLocalizationMiddlewareTest.
 *
 * @group localization
 * @group api
 */
class CheckLocalizationMiddlewareTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/localizations';

    protected array $access = [
        'permissions' => '',
        'roles' => '',
    ];

    public function testIfMiddlewareSetsDefaultAppLanguage(): void
    {
        $data = [];
        $requestHeaders = [];
        $defaultLanguage = Config::get('app.locale');

        $response = $this->makeCall($data, $requestHeaders);

        $response->assertStatus(200)
            ->assertHeader('content-language', $defaultLanguage);
    }

    public function testIfMiddlewareSetsCustomLanguage(): void
    {
        $language = 'fr';
        $data = [];
        $requestHeaders = [
            'accept-language' => $language,
        ];

        $response = $this->makeCall($data, $requestHeaders);

        $response->assertStatus(200)
            ->assertHeader('content-language', $language);
    }

    public function testIfMiddlewareThrowsErrorOnWrongLanguage(): void
    {
        $language = 'xxx';
        $data = [];
        $requestHeaders = [
            'accept-language' => $language,
        ];

        $response = $this->makeCall($data, $requestHeaders);

        $response->assertStatus(412);
    }
}

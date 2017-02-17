<?php

namespace App\Ship\Test\PHPUnit\Abstracts;

use App\Ship\Test\PHPUnit\Traits\CustomTestsHelpersTrait;
use App\Ship\Test\PHPUnit\Traits\GeneralTestsHelpersTrait;
use App\Ship\Test\PHPUnit\Traits\TestCaseTrait;
use App\Ship\Test\PHPUnit\Traits\TestingTrait;
use App\Ship\Test\PHPUnit\Traits\TestingUserTrait;
use Faker\Generator;
use Illuminate\Contracts\Console\Kernel as LaravelKernel;
use Laravel\BrowserKitTesting\TestCase as LaravelFivePointThreeTestCaseCompatibilityPackage;

//use Illuminate\Foundation\Testing\TestCase as LaravelTestCase;

/**
 * Class TestCase.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class TestCase extends LaravelFivePointThreeTestCaseCompatibilityPackage
{

    use TestCaseTrait, GeneralTestsHelpersTrait, TestingUserTrait, CustomTestsHelpersTrait;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl;

    /**
     * Setup the test environment, before each test.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        // migrate the database
        $this->migrateDatabase();

        // seed the database
        $this->seed();
    }

    /**
     * Reset the test environment, after each test.
     */
    public function tearDown()
    {
        $this->artisan('migrate:reset');
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $this->baseUrl = env('API_FULL_URL'); // this reads the value from `phpunit.xml` during testing

        // override the default subDomain of the base URL when subDomain property is declared inside a test
        if (property_exists($this, 'subDomain')) {
            $this->overrideSubDomain($this->subDomain);
        }

        $app = require __DIR__ . '/../../../../../bootstrap/app.php';

        $app->make(LaravelKernel::class)->bootstrap();

        // create instance of faker and make it available in all tests
        $this->faker = $app->make(Generator::class);

        return $app;
    }
}

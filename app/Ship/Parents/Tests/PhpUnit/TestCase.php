<?php

namespace App\Ship\Parents\Tests\PhpUnit;

use App\Ship\Engine\Traits\HashIdTrait;
use App\Ship\Tests\PhpUnit\TestingTrait;
use App\Ship\Tests\PhpUnit\TestsAuthHelperTrait;
use App\Ship\Tests\PhpUnit\TestsCustomHelperTrait;
use App\Ship\Tests\PhpUnit\TestsMockHelperTrait;
use App\Ship\Tests\PhpUnit\TestsRequestHelperTrait;
use App\Ship\Tests\PhpUnit\TestsResponseHelperTrait;
use App\Ship\Tests\PhpUnit\TestsUploadHelperTrait;
use Faker\Generator;
use Illuminate\Contracts\Console\Kernel as LaravelKernel;
use Illuminate\Foundation\Testing\TestCase as LaravelTestCase;

/**
 * Class TestCase.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class TestCase extends LaravelTestCase
{

    use TestCaseTrait,
        TestsRequestHelperTrait,
        TestsResponseHelperTrait,
        TestsMockHelperTrait,
        TestsAuthHelperTrait,
        TestsUploadHelperTrait,
        TestsCustomHelperTrait,
        HashIdTrait;

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

        // Install Passport Client for Testing
        $this->setupPassportOAuth2();
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
        $this->overrideSubDomain();

        $app = require __DIR__ . '/../../../../../bootstrap/app.php';

        $app->make(LaravelKernel::class)->bootstrap();

        // create instance of faker and make it available in all tests
        $this->faker = $app->make(Generator::class);

        return $app;
    }
}

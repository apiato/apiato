<?php

namespace App\Port\Tests\PHPUnit\Abstracts;

use Illuminate\Contracts\Console\Kernel as LaravelPort;
use Illuminate\Foundation\Testing\TestCase as LaravelTestCase;
use App\Port\Tests\PHPUnit\Traits\TestingTrait;
use Illuminate\Support\Facades\Config;

/**
 * Class TestCase.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class TestCase extends LaravelTestCase
{

    use TestingTrait;

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
        $this->artisan('migrate');

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
        $this->baseUrl = Config::get('api.full_url'); // this reads the value from `phpunit.xml` during testing

        $app = require __DIR__ . '/../../../../../bootstrap/app.php';

        $app->make(LaravelPort::class)->bootstrap();

        return $app;
    }
}

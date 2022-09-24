<?php
namespace Tj\Ghwebhook\Tests;

use Illuminate\Support\Facades\Log;
use Orchestra\Testbench\TestCase as BaseTest;

class TestCase extends BaseTest
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            \Tj\Ghwebhook\PackageServiceProvider::class,
            \Spatie\LaravelRay\RayServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        //
    }
}

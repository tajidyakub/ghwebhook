<?php
namespace Tj\Ghwebhook\Tests;

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
            \Tj\Ghwebhook\PackageServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        //
    }
}

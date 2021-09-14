<?php

namespace Hsy\Shipping\Tests;


use Hsy\Shipping\ShippingServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();


    }

    protected function getPackageProviders($app)
    {
        return [
            ShippingServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {

        // Setup default database to use sqlite :memory:
        $app['config']->set('app.locale', 'fa');
        $app['config']->set('app.faker_locale', 'fa_IR');
        $app['config']->set('app.timezone', 'Asia/tehran');
        $app['config']->set('database.default', 'testdb');
        $app['config']->set('database.connections.testdb', [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ]);
    }
}
<?php

use Illuminate\Database\Capsule\Manager as DB;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $this->setUpDatabase($app);
    }

    protected function getPackageProviders($app)
    {
        return [
            \Weerd\ApolloPages\ApolloPagesServiceProvider::class
        ];
    }

    /**
     * Setup the test case data persistance layer.
     */
    public function setUp()
    {
        parent::setUp();

        $this->artisan('migrate', ['--database' => 'apollo_pages']);

        // Cannot run scaffold command since not expected directory structure...
        // $this->artisan('apollo:scaffold');
    }

    /**
     * Setup the in-memory database.
     */
    protected function setUpDatabase($app)
    {
        $app['config']->set('database.default', 'apollo_pages');
        $app['config']->set('database.connections.apollo_pages', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }
}

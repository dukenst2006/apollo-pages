<?php

use Illuminate\Database\Capsule\Manager as DB;

abstract class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Setup the test case data persistance layer.
     *
     * @return void
     */
    public function setUp()
    {
        $this->setUpDatabase();
        $this->migrateTables();
    }

    /**
     * Setup the in-memory database for testing.
     *
     * @return void
     */
    protected function setUpDatabase()
    {
        $database = new DB;

        $database->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $database->bootEloquent();
        $database->setAsGlobal();
    }

    /**
     * Run any migrations to setup the schema for the database.
     */
    public function migrateTables()
    {
        DB::schema()->create('pages', function ($table) {
            $table->increments('id');

            $table->string('slug')->index();
            $table->string('path')->unique();
            $table->integer('tier');
            $table->integer('parent_id')->nullable();

            $table->string('title');
            $table->text('body')->nullable();
            $table->text('body_html')->nullable();
            $table->timestamps();
        });
    }
}

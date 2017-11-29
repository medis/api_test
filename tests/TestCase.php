<?php

namespace Tests;

abstract class TestCase extends \Laravel\Lumen\Testing\TestCase
{

    public function setUp() {
        parent::setUp();
        \Illuminate\Support\Facades\Artisan::call('db:seed', [
            '--force' => true
        ]);
    }
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }
}

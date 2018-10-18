<?php

namespace Tests\Feature;

use Tests\TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;

class EndpointTest extends TestCase
{
    use DatabaseMigrations;

    protected $queries;

    public function setUp()
    {
        parent::setUp();
        $this->queries = include(__DIR__ . '/Objects/queries.php');
    }

    /** @test */
    public function it_can_access_endpoints()
    {
        $response = $this->call('GET', '/graphql', [
            'query' => $this->queries['examples']
        ]);

        $this->assertEquals($response->getStatusCode(), 200);
    }
}
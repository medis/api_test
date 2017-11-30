<?php

namespace Tests\Feature;

use Tests\TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;
use App\Recipe;

class RecipeCRUDTest extends TestCase
{
    use DatabaseMigrations;
    
    public function setUp() {
        parent::setUp();
    }

    /** @test */
    public function a_user_can_fetch_recipe_by_id() {
        $this->get('/api/v1/recipes/1')
            ->seeStatusCode(200)
            ->seeJsonContains(['title' => Recipe::find(1)->title]);
    }
}
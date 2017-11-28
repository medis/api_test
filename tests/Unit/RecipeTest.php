<?php

namespace Tests\Unit;

use Tests\TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;
use App\Recipe;

class RecipeTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp() {
        parent::setUp();
        dd('aa');
    }

    /** @test */
    public function a_recipe_has_relationships() {
        $recipe = Recipe::all();
        dd($recipe);
    }
}
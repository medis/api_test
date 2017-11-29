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
    }

    /** @test */
    public function a_recipe_has_relationships() {
        $recipe = Recipe::first();
        $this->assertInstanceOf('App\BoxType', $recipe->boxType);
        $this->assertInstanceOf('App\RecipeDietType', $recipe->recipeDietType);
        $this->assertInstanceOf('App\Season', $recipe->season);
        $this->assertInstanceOf('App\Base', $recipe->base);
        $this->assertInstanceOf('App\ProteinSource', $recipe->proteinSource);
        $this->assertInstanceOf('App\EquipmentNeeded', $recipe->equipmentNeeded);
        $this->assertInstanceOf('App\OriginCountry', $recipe->originCountry);
        $this->assertInstanceOf('App\RecipeCuisine', $recipe->recipeCuisine);
    }

    /** @test */
    public function a_recipe_has_reverse_relationships() {
        $title = 'Sweet Chilli and Lime Beef on a Crunchy Fresh Noodle Salad';
        $this->assertEquals($title, $this->getRecipeTitle(\App\BoxType::class));
        $this->assertEquals($title, $this->getRecipeTitle(\App\RecipeDietType::class));
        $this->assertEquals($title, $this->getRecipeTitle(\App\Season::class));
        $this->assertEquals($title, $this->getRecipeTitle(\App\Base::class));
        $this->assertEquals($title, $this->getRecipeTitle(\App\ProteinSource::class));
        $this->assertEquals($title, $this->getRecipeTitle(\App\EquipmentNeeded::class));
        $this->assertEquals($title, $this->getRecipeTitle(\App\OriginCountry::class));
        $this->assertEquals($title, $this->getRecipeTitle(\App\RecipeCuisine::class));
    }

    private function getRecipeTitle($_class) {
        return $_class::first()->recipes()->first()->title;
    }
}
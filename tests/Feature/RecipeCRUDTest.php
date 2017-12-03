<?php

namespace Tests\Feature;

use Tests\TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;
use App\Recipe;

class RecipeCRUDTest extends TestCase
{
    use DatabaseMigrations;

    protected $recipe;

    public function setUp() {
        parent::setUp();
        $this->recipe = Recipe::find(1);
    }

    /** @test */
    public function a_user_can_fetch_recipe_by_id() {
        $this->get('/api/v1/recipes/1')
            ->seeStatusCode(200)
            ->seeJsonContains([
                'title' => $this->recipe->title,
                'origin_country' => $this->recipe->originCountry->title,
                'gousto_reference' => $this->recipe->gousto_reference
            ]);
    }

    /** @test */
    public function a_mobile_user_can_fetch_recipe_by_id() {
        $this->get('/api/v1/recipes/1/mobile')
            ->seeStatusCode(200)
            ->seeJsonContains([
                'title' => $this->recipe->title,
                'carbs_grams' => $this->recipe->carbs_grams,
                'bulletpoint2' => $this->recipe->bulletpoint2
            ])
            ->dontSeeJson([
                'origin_country' => $this->recipe->originCountry->title
            ]);
    }

    /** @test */
    public function a_frontend_user_can_fetch_recipe_by_id() {
        $this->get('/api/v1/recipes/1/frontend')
            ->seeStatusCode(200)
            ->seeJsonContains([
                'title' => $this->recipe->title,
                'marketing_description' => $this->recipe->marketing_description
            ])
            ->dontSeeJson([
                'carbs_grams' => $this->recipe->carbs_grams,
                'bulletpoint2' => $this->recipe->bulletpoint2
            ]);
    }

    /** @test */
    public function a_user_can_fetch_recipes_by_cuisine() {
        $cuisine = 'asian';
        $recipe = \App\RecipeCuisine::find($cuisine)->recipes()->first();
        $this->get("/api/v1/cuisine/{$cuisine}")
            ->seeStatusCode(200)
            ->seeJsonContains(['title' => $recipe->title]);
        // Whether the pagination is working correctly is tested by Lumen/Laravel.
    }
}
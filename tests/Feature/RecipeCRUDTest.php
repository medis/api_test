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

    /** @test */
    public function a_user_can_update_an_existing_recipe() {
        $post = $this->recipe->toArray();
        $new_title = 'This is a new title';
        $post['title'] = $new_title;

        $this->post("/api/v1/recipes/{$this->recipe->id}", $post)
             ->seeStatusCode(200)
             ->seeJsonContains(['title' => $new_title]);
    }

    /** @test */
    public function recipe_update_validates_correctly() {
        // Test if it is not possible to duplicate title.
        $post = $this->recipe->toArray();
        $post['title'] = Recipe::find(2)->title;

        $this->post("/api/v1/recipes/{$this->recipe->id}", $post)
             ->seeStatusCode(422)
             ->seeJsonContains(['title' => ['The title has already been taken.']]);

        // Min value test.
        $post = $this->recipe->toArray();
        $post['calories_kcal'] = -1;
        $this->post("/api/v1/recipes/{$this->recipe->id}", $post)
             ->seeStatusCode(422)
             ->seeJsonContains(['calories_kcal' => ['The calories kcal must be at least 0.']]);

        // Id validation.
        $post = $this->recipe->toArray();
        $post['id'] = 9999;
        $this->post("/api/v1/recipes/{$this->recipe->id}", $post)
            ->seeStatusCode(422)
            ->seeJsonContains(['id' => ['The selected id is invalid.']]);
    }

    /** @test */
    public function a_user_can_create_recipe() {
        $post = [
            'title' => 'New recipe',
            'short_title' => 'New',
            'carbs_grams' => 12
        ];

        $this->post("/api/v1/recipes", $post)
             ->seeStatusCode(200)
             ->seeJsonContains($post);
    }

    /** @test */
    public function new_recipe_must_contain_unique_title() {
        $post = [
            'title' => $this->recipe->title,
            'short_title' => 'New',
            'carbs_grams' => 12
        ];

        $this->post("/api/v1/recipes", $post)
             ->seeStatusCode(422)
             ->seeJsonContains(['title' => ['The title has already been taken.']]);
    }
}
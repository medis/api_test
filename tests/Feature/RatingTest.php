<?php

namespace Tests\Feature;

use Tests\TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;
use App\Recipe;

class RatingTest extends TestCase
{
    use DatabaseMigrations;

    protected $recipe;

    public function setUp() {
        parent::setUp();
        $this->recipe = Recipe::find(1);
    }

    /** @test */
    public function a_user_can_rate_recipe() {
        $rating = make('App\Rating', ['recipe_id' => $this->recipe->id, 'ip' => NULL]);

        $this->post('/api/v1/rating', $rating->toArray())
             ->seeStatusCode(200)
             ->seeJsonContains([
                 'rating' => $rating->rating,
                 'recipe_id' => $rating->recipe_id
             ]);
    }

    /** @test */
    public function a_rating_correctly_validates() {
        $false_rating = [
            'racipe_id' => 1,
            'rating' => 6
        ];

        $this->post('/api/v1/rating', $false_rating)
             ->seeStatusCode(422)
             ->seeJsonContains(['rating' => ['The rating must be between 1 and 5.']]);

        $false_recipe = [
            'rating' => 3,
            'recipe_id' => 35
        ];

        $this->post('/api/v1/rating', $false_recipe)
             ->seeStatusCode(422)
             ->seeJsonContains(['recipe_id' => ['The selected recipe id is invalid.']]);
    }
}
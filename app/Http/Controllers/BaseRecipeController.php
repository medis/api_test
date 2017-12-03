<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\RecipeCuisine;

abstract class BaseRecipeController extends Controller
{
    /**
     * Resource filter.
     *
     * @var Illuminate\Http\Resources\Json\Resource
     */
    protected $resource;

    public function __construct($resource) {
        $this->resource = $resource;
    }

    /**
     * Show recipe by id.
     *
     * @param integer $id
     * @return void
     */
    public function show($id) {
        if ($recipe = Recipe::find($id)) {
            return new $this->resource($recipe);
        }

        return $this->notFoundResponse();
    }

    /**
     * Show recipes filtered by cuisine.
     *
     * @param string $cuisine
     * @return void
     */
    public function showCuisine($cuisine) {
        if ($cuisine = RecipeCuisine::find($cuisine)) {
            return $this->resource::collection($cuisine->recipes()->paginate(1));
        }

        return $this->notFoundResponse();
    }

    /**
     * Update recipe.
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'id' => 'required|exists:recipes,id',
            'title' => "required|unique:recipes,title,{$id}",
            'calories_kcal' => 'integer|min:0',
            'protein_grams' => 'integer|min:0',
            'fat_grams' => 'integer|min:0',
            'carbs_grams' => 'integer|min:0',
            'preparation_time_minutes' => 'integer|min:0',
            'shelf_life_days' => 'integer|min:0',
            'gousto_reference' => 'integer|min:1',
            'box_type_id' => 'integer|exists:box_types,id',
            'recipe_diet_type_id' => 'integer|exists:recipe_diet_types,id',
            'season_id' => 'integer|exists:seasons,id',
            'base_id' => 'integer|exists:bases,id',
            'protein_source_id' => 'integer|exists:protein_sources,id',
            'equipment_needed_id' => 'integer|exists:equipment_needed,id',
            'origin_country_id' => 'integer|exists:origin_countries,id',
            'recipe_cuisine_id' => 'integer|exists:recipe_cuisines,id'
        ]);

        $recipe = Recipe::find($id);
        // In Laravel 5.5 it is possible to pass in returned values from validation above,
        // Which looks a bit cleaner and secure.
        tap($recipe)->update($request->all());

        return ['data' => [ new $this->resource($recipe) ]];
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required|unique:recipes,title'
        ]);
    }

    /**
     * Error for resource not found exception.
     */
    protected function notFoundResponse() {
        $response = [
            'code' => 404,
            'status' => 'error',
            'data' => 'Resource Not Found',
            'message' => 'Not Found'
        ];
        return response()->json($response, $response['code']);
    }

}

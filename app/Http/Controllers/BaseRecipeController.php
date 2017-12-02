<?php

namespace App\Http\Controllers;

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

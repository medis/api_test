<?php

namespace App\Http\Controllers;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\RecipeResource;
use App\Recipe;

abstract class BaseRecipeController extends Controller
{
    public function __construct($resource) {
        $this->resource = $resource;
    }

    protected function index() {
        return Recipe::paginate(5);
    }

    public function show($id) {
        if ($recipe = Recipe::find($id)) {
            return new $this->resource($recipe);
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

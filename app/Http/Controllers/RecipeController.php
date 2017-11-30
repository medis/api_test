<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecipeResource;
use App\Recipe;

class RecipeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    public function index() {
        return Recipe::all();
    }

    public function show($id) {
        if ($recipe = Recipe::find($id)) {
            return new RecipeResource(Recipe::find($id));
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

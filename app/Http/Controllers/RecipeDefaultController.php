<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecipeResource;

class RecipeDefaultController extends BaseRecipeController
{

    public function __construct() {
        parent::__construct(RecipeResource::class);
    }

    /**
     * Fetch Recipe.
     * Catch undetected consumer and do stuff with it here.
     *
     * @param integer $id
     * @param string $consumer
     * @return void
     */
    public function show($id, $consumer = NULL) {
        return parent::show($id);
    }
}

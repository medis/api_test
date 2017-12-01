<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecipeFrontendResource;

class RecipeFrontendController extends BaseRecipeController
{
    public function __construct() {
        parent::__construct(RecipeFrontendResource::class);
    }
}

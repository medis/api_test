<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecipeMobileResource;

class RecipeMobileController extends BaseRecipeController
{
    public function __construct() {
        parent::__construct(RecipeMobileResource::class);
    }
}

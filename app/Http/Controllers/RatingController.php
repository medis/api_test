<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Rating;

class RatingController extends Controller
{
    public function store(Request $request)  {
        // Seems like as of now, Lumen does not return validated attributes
        // like Laravel 5.5 does.
        $this->validate($request, [
            'recipe_id' => 'required|integer|exists:recipes,id',
            'rating'    => 'required|integer|between:1,5'
        ]);

        $post = [
            'recipe_id' => $request->recipe_id,
            'ip' => $request->getClientIp(),
            'rating' => $request->rating
        ];

        $rating = Rating::create($post);

        return ['data' => [
            'id' => $rating->id,
            'rating' => $rating->rating,
            'recipe_id' => $rating->recipe->id
        ]];
    }
}

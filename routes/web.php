<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function() use ($router) {
    return $router->app->version();
});

// Seems like Lumen does not support ::resource router.
$router->group(['prefix' => 'api/v1', 'middleware' => 'memory_db'], function () use ($router) {
    $router->get('recipes/{id}/mobile', ['uses' => 'RecipeMobileController@show']);
    $router->get('recipes/{id}/frontend', ['uses' => 'RecipeFrontendController@show']);
    // Catch requests without consumer or any other consumer not listed above.
    $router->get('recipes/{id}[/{consumer:[A-Za-z]+}]', ['uses' => 'RecipeDefaultController@show']);

    $router->get('cuisine/{name}/mobile', ['uses' => 'RecipeMobileController@showCuisine']);
    $router->get('cuisine/{name}/frontend', ['uses' => 'RecipeFrontendController@showCuisine']);
    $router->get('cuisine/{name}[/{consumer:[A-Za-z]+}]', ['uses' => 'RecipeDefaultController@showCuisine']);

    // Rate recipe.
    $router->post('rating', ['uses' => 'RatingController@store']);

    // Update recipe
    $router->post('recipes/{id}', ['uses' => 'RecipeDefaultController@update']);
});
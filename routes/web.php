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

$router->group(['prefix' => 'api/v1', 'middleware' => 'memory_db'], function () use ($router) {
    // $router->get('recipes', ['uses' => 'RecipeController@index']);
    $router->get('recipes/{id}/mobile', ['uses' => 'RecipeMobileController@show']);
    $router->get('recipes/{id}/frontend', ['uses' => 'RecipeFrontendController@show']);
    $router->get('recipes/{id}[/{consumer:[A-Za-z]+}]', ['uses' => 'RecipeDefaultController@show']);
});
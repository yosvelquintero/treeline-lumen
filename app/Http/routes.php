<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// $app->get('/', function () use ($app) {
//     return $app->welcome();
// });

$app->group(['prefix' => 'api', 'middleware' => 'jwt.auth'], function ($app) {
    $app->post('/projects', 'App\Http\Controllers\ProjectsController@store');
    $app->put('/projects/{id}', 'App\Http\Controllers\ProjectsController@update');
    $app->delete('/projects/{id}', 'App\Http\Controllers\ProjectsController@destroy');
});

$app->group(['prefix' => 'api'], function ($app) {
    $app->get('/projects', 'App\Http\Controllers\ProjectsController@index');
    $app->get('/projects/{id}', 'App\Http\Controllers\ProjectsController@show');
});

$app->post('auth/login', 'App\Http\Controllers\Auth\AuthController@postLogin');

<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use Illuminate\Support\Facades\DB;

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('employees/{id}', ['uses' => 'EmployeeController@show']);
    $router->post('employees', ['uses' => 'EmployeeController@create']);
    $router->put('employees/{id}', ['uses' => 'EmployeeController@update']);
    $router->delete('employees/{id}', ['uses' => 'EmployeeController@delete']);

    $router->get('employees/{id}/children', ['uses' => 'EmployeeController@children']);
    $router->get('employees/search/{field}/{value}', 'EmployeeController@search');
});

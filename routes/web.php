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

$router->get('/', function () use ($router) {
  return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
  $router->get('authors', ['uses' => 'AuthorController@showAllAuthors']);

  $router->get('authors/{id}', ['uses' => 'AuthorController@showOneAuthor']);

  $router->post('authors', ['uses' => 'AuthorController@create']);

  $router->delete('authors/{id}', ['uses' => 'AuthorController@delete']);

  $router->put('authors/{id}', ['uses' => 'AuthorController@update']);

  // Matches "/api/register
  $router->post('register', 'AuthController@register');
  // Matches "/api/login
  $router->post('login', 'AuthController@login');

  // Matches "/api/profile
  $router->get('profile', 'UserController@profile');

  // Matches "/api/users/1 
//get one user by id
  $router->get('users/{id}', 'UserController@singleUser');

  // Matches "/api/users
  $router->get('users', 'UserController@allUsers');

  $router->get('dummydata', 'DummyAPI@getData');

  $router->post('postDataAPI', 'EmployeeController@addEmployee');
  $router->post('postListDataAPI', 'EmployeeController@addEmployees');
  $router->put('putEmpAPI', 'EmployeeController@updateEmployee');
  $router->delete('deleteEmpAPI/{id}', 'EmployeeController@deleteEmployee');
  $router->get('searchEmpAPI/{name}', 'EmployeeController@searchEmployee');
  $router->post('validatedPostAPI', 'EmployeeController@validatedDataPost');
});


<?php

/** @var Router $router */

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

use Laravel\Lumen\Routing\Router;

$router->get('/', ['uses' => 'Controller@checkDbConnection']);

//Worker
$router->post('/worker', ['uses' => 'WorkerController@ajaxStore']);
$router->get('/worker', ['uses' => 'WorkerController@ajaxList']);

$router->post('/employment', ['uses' => 'EmploymentController@ajaxStore']);
$router->patch('/employment', ['uses' => 'EmploymentController@ajaxUpdate']);

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    // Route::get('/test', function(Request $request) {
    //     return 'Authenticated';
    // });
    
    JsonApiRoute::server('v1')
        ->prefix('v1')
        ->namespace('App\Http\Controllers\Api\V1')
        ->resources(function ($server) {
            $server->resource('users')
                ->parameter('id')
                ->relationships(function ($relationships) {
                    $relationships->hasMany('tasks');
                });
            $server->resource('tasks')
                ->parameter('id')
                ->relationships(function ($relationships) {
                    $relationships->hasMany('assignees');
                    $relationships->hasOne('creator');
                });

        });
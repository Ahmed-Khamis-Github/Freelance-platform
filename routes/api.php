<?php

use App\Http\Controllers\Api\AuthTokensController;
use App\Http\Controllers\Api\ProjectsController;
use App\Http\Middleware\CheckApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

 
 
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });


    Route::apiResource('projects', ProjectsController::class);


    Route::get('auth/tokens', [AuthTokensController::class, 'index'])->middleware('auth:sanctum');


    Route::post('auth/tokens', [AuthTokensController::class, 'store'])
        ->middleware('guest:sanctum');


    Route::delete('auth/tokens', [AuthTokensController::class, 'delete'])->middleware('auth:sanctum');
 ;

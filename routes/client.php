<?php
use Illuminate\Support\Facades\Route ;

use App\Http\Controllers\Client\ProjectController;

Route::group([
    'prefix'=>'client',
    'as'=>'client.' ,
    'middleware'=>['auth'] 
],function(){
    Route::resource('projects', ProjectController::class);
}) ;
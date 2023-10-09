<?php

use App\Http\Controllers\Freelancer\ProfileController;
use App\Http\Controllers\Freelancer\ProposalController;
use Illuminate\Support\Facades\Route ;
 
Route::group([
   'prefix'=>'freelancer' ,
   'middleware'=>['auth'] ,
   'as'=>'freelancer.'
],function(){
    Route::get('proposals',[ProposalController::class,'index'])
    ->name('proposals.index') ;
    Route::get('proposals/{project}/create',[ProposalController::class,'create']) 
    ->name('proposals.create') ;
    Route::post('proposals/{project}/create',[ProposalController::class,'store'])
    ->name('proposals.store') ;

    Route::get('profile',[ProfileController::class,'edit'] )
    ->name('profile.edit') ;

    Route::put('profile',[ProfileController::class,'update'] )
    ->name('profile.update') ;
   



}) ;
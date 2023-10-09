<?php 
 use Illuminate\Support\Facades\Route ;
 use App\Http\Controllers\Dashboard\CategoriesController ;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\ConfigController ;

Route::group(['prefix' => 'dashboard/','middleware'=>['auth:admin,web','verified']], function () {
    Route::resource('roles',RolesController::class) ;
    Route::get('config', [ConfigController::class, 'index'])->name('config');
    Route::post('config', [ConfigController::class, 'store']);
    Route::get('categories/trash',[CategoriesController::class,'trash'])->name('trash') ;
    Route::put('categories/trash/{id}/restore',[CategoriesController::class,'restore'])->name('restore') ;
    Route::delete('categories/trash/{id}',[CategoriesController::class,'forceDelete'])->name('forceDelete') ;

    Route::resource('categories',CategoriesController::class) ;
});



?>
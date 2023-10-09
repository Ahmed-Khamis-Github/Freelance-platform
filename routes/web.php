<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Models\Project;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization ;
use App\Http\Controllers\PaymentsController ;
use App\Http\Controllers\PaymentsCallbackController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
     Route::get('/', [HomeController::class,'index'])->name('home');


});


Route::get('welcome', function () {
    return view('welcoome');
}) ;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('otp/request', [OtpController::class, 'create'])->name('otp.create');
Route::post('otp/request', [OtpController::class, 'store']);
Route::get('otp/verify', [OtpController::class, 'verifyForm'])->name('otp.verify');
Route::post('otp/verify', [OtpController::class, 'verify']);

// require __DIR__.'/auth.php';

// Route::group(['prefix'=>'admin','as'=>'admin.'],function(){
//     require __DIR__.'/auth.php';

// }) ;

Route::get('projects/{project}',[ProjectController::class,'show'])->name('project.show') ;

Route::get('messages',[MessageController::class,'create'])->name('messages') ;

Route::post('messages',[MessageController::class,'store'])  ;


Route::get('payments/create', [PaymentsController::class, 'create'])->name('payments.create');
Route::get('/payments/callback/success', [PaymentsCallbackController::class, 'success'])->name('payments.success');
Route::get('/payments/callback/cancel', [PaymentsCallbackController::class, 'cancel'])->name('payments.cancel');

 


require __DIR__.'/dashboard.php' ;
require __DIR__.'/freelancer.php' ;

require __DIR__.'/client.php' ;



 
<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['prefix' => 'admin',  'middleware' => ['auth','admin']], function(){
	
	Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('home')->middleware('admin');
	Route::get('/list-staff', [App\Http\Controllers\AdminController::class, 'liststaff'])->middleware('admin');
	Route::get('/add-staff', [App\Http\Controllers\AdminController::class, 'addstaff'])->middleware('admin');
	Route::get('/edit-staff/{id}', [App\Http\Controllers\AdminController::class, 'addstaff'])->middleware('admin');
	Route::get('/delete-staff/{id}', [App\Http\Controllers\AdminController::class, 'deletestaff'])->middleware('admin');
	Route::post('/save-staff', [App\Http\Controllers\AdminController::class, 'savestaff'])->middleware('admin');
	
	Route::get('/list-customerdetails', [App\Http\Controllers\AdminController::class, 'listcustomerdetails'])->middleware('admin');
	Route::get('/add-customerdetails', [App\Http\Controllers\AdminController::class, 'addcustomerdetails'])->middleware('admin');
	Route::get('/edit-customerdetails/{id}', [App\Http\Controllers\AdminController::class, 'editcustomerdetails'])->middleware('admin');
	Route::get('/delete-customerdetails/{id}', [App\Http\Controllers\AdminController::class, 'deletecustomerdetails'])->middleware('admin');
	Route::post('/save-customerdetails', [App\Http\Controllers\AdminController::class, 'savecustomerdetails'])->middleware('admin');
	Route::post('/cities', [App\Http\Controllers\AdminController::class, 'cities'])->middleware('admin');
});

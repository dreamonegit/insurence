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
	Route::post('/state', [App\Http\Controllers\AdminController::class, 'state'])->middleware('admin');
	
	Route::get('/list-customerdetails', [App\Http\Controllers\AdminController::class, 'listcustomerdetails'])->middleware('admin');
	Route::get('/add-customerdetails', [App\Http\Controllers\AdminController::class, 'addcustomerdetails'])->middleware('admin');
	Route::get('/edit-customerdetails/{id}', [App\Http\Controllers\AdminController::class, 'editcustomerdetails'])->middleware('admin');
	Route::get('/delete-customerdetails/{id}', [App\Http\Controllers\AdminController::class, 'deletecustomerdetails'])->middleware('admin');
	Route::post('/save-customerdetails', [App\Http\Controllers\AdminController::class, 'savecustomerdetails'])->middleware('admin');

});


Route::group(['prefix' => 'insurance',  'middleware' => ['auth','admin']], function(){
	Route::post('/save-customerdetails', [App\Http\Controllers\InsuranceController::class, 'savecustomerdetails']);
	Route::post('/state', [App\Http\Controllers\Controllers::class, 'state']);
	Route::get('/add-insurance', [App\Http\Controllers\InsuranceController::class, 'index'])->name('addinsurence');
	



	Route::get('/select-insurance', [App\Http\Controllers\InsuranceController::class, 'selectinsurance'])->name('selectinsurence');
	Route::post('/save-insurance-type', [App\Http\Controllers\InsuranceController::class, 'saveselectinsurance']);


	Route::get('/health-insurance', [App\Http\Controllers\InsuranceController::class, 'healthinsurance'])->name('healthinsurance');
	Route::get('/motor-insurance', [App\Http\Controllers\InsuranceController::class, 'motorinsurance'])->name('motorinsurance');
    Route::get('/life-insurance', [App\Http\Controllers\InsuranceController::class, 'lifeinsurance'])->name('lifeinsurance');

	Route::post('/save-health-insurance', [App\Http\Controllers\InsuranceController::class, 'savehealthinsurance']);
	Route::post('/save-motor-insurance', [App\Http\Controllers\InsuranceController::class, 'savemotorinsurance']);
	Route::post('/save-life-insurance', [App\Http\Controllers\InsuranceController::class, 'savelifeinsurance']);


	Route::get('/insurance-complete', [App\Http\Controllers\InsuranceController::class, 'insurance_complete'])->name('insurance_complete');
});



Route::group(['prefix' => 'customer',  'middleware' => ['auth','admin']], function(){

	Route::get('/view-customer/{id}', [App\Http\Controllers\CustomerController::class, 'viewcustomer'])->name('viewcustomer');
	
});
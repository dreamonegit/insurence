<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ClearFormSession;

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
    return view('auth.login');
});

Auth::routes();
Route::group(['prefix' => 'admin',  'middleware' => ['auth','admin',ClearFormSession::class]], function(){
	
	Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('home')->middleware('admin');
	Route::get('/list-staff', [App\Http\Controllers\AdminController::class, 'liststaff'])->middleware('admin');
	Route::get('/add-staff', [App\Http\Controllers\AdminController::class, 'addstaff'])->middleware('admin');
	Route::get('/edit-staff/{id}', [App\Http\Controllers\AdminController::class, 'addstaff'])->middleware('admin');
	Route::get('/delete-staff/{id}', [App\Http\Controllers\AdminController::class, 'deletestaff'])->middleware('admin');
	Route::post('/save-staff', [App\Http\Controllers\AdminController::class, 'savestaff'])->middleware('admin');
	Route::post('/export-staff', [App\Http\Controllers\AdminController::class, 'exportstaff'])->middleware('admin');
	Route::post('/state', [App\Http\Controllers\AdminController::class, 'state'])->middleware('admin');
	
	Route::get('/list-customerdetails', [App\Http\Controllers\AdminController::class, 'listcustomerdetails'])->middleware('admin');
	Route::get('/add-customerdetails', [App\Http\Controllers\AdminController::class, 'addcustomerdetails'])->middleware('admin');
	Route::get('/edit-customerdetails/{id}', [App\Http\Controllers\AdminController::class, 'editcustomerdetails'])->middleware('admin');
	Route::get('/delete-customerdetails/{id}', [App\Http\Controllers\AdminController::class, 'deletecustomerdetails'])->middleware('admin');

	Route::get('/list-customerdetails/{id}', [App\Http\Controllers\AdminController::class, 'listcustomerdetails'])->middleware('admin');

	Route::post('/save-customerdetails', [App\Http\Controllers\AdminController::class, 'savecustomerdetails'])->middleware('admin');
	Route::post('/export-customerdetails', [App\Http\Controllers\AdminController::class, 'exportcustomerdetails'])->middleware('admin');
	Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->middleware('admin');
	Route::any('/myprofile', [App\Http\Controllers\AdminController::class, 'myprofile'])->middleware('admin');

});


Route::group(['prefix' => 'insurance',  'middleware' => ['auth','admin']], function(){
	Route::post('/save-customerdetails', [App\Http\Controllers\InsuranceController::class, 'savecustomerdetails']);
	Route::post('/state', [App\Http\Controllers\Controllers::class, 'state']);
	Route::get('/add-insurance', [App\Http\Controllers\InsuranceController::class, 'index'])->name('addinsurence');
	



	Route::get('/select-insurance', [App\Http\Controllers\InsuranceController::class, 'selectinsurance'])->name('selectinsurence');
	Route::post('/save-insurance-type', [App\Http\Controllers\InsuranceController::class, 'saveselectinsurance']);


	Route::get('/health-insurance', [App\Http\Controllers\InsuranceController::class, 'healthinsurance'])->name('healthinsurance');
	
	Route::post('/save-health-insurance', [App\Http\Controllers\InsuranceController::class, 'savehealthinsurance']);
	


	Route::get('/insurance-complete', [App\Http\Controllers\InsuranceController::class, 'insurance_complete'])->name('insurance_complete');


	Route::get('/edit-insurance/{id}', [App\Http\Controllers\InsuranceController::class, 'editinsurance'])->name('editinsurance');
});



Route::group(['prefix' => 'customer',  'middleware' => ['auth','admin',ClearFormSession::class]], function(){

	Route::get('/view-customer/{id}', [App\Http\Controllers\CustomerController::class, 'viewcustomer'])->name('viewcustomer');
	
});
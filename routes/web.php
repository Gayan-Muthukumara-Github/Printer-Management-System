<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RatesController;
use App\Http\Controllers\PrinterCategolsController;
use App\Http\Controllers\CustomersController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContractsController;
use App\Http\Controllers\DatafeedsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\PriceListController;
use App\Http\Controllers\CustomerPortalController;
use App\Http\Controllers\DispatchController;
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



Auth::routes();

Route::get('/', function () {
    return redirect(route('login'));
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('companies', CompanyController::class);
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::resource('rates', RatesController::class, ['only' => ['store', 'index']]);
Route::resource('printers', PrinterCategolsController::class);
Route::resource('customers', CustomersController::class);
Route::get('/contracts/{id}/rate-crad', [ContractsController::class, 'ratecrad']);
Route::get('/contracts/{id}/printers', [ContractsController::class, 'printers']);
Route::post('/contracts/{id}/bulk_printers', [ContractsController::class, 'bulk_printers']);
Route::get('/contracts/{id}/check_printers', [ContractsController::class, 'check_printers']);
Route::post('/contracts/{id}/add_ratecrad', [ContractsController::class, 'add_ratecrad']);
Route::get('/contracts/{id}/ratecrad/{ratecard}', [ContractsController::class, 'contract_ratecard']);
Route::resource('/datafeed', DatafeedsController::class, ['only' => ['store', 'index']]);

Route::resource('contracts', ContractsController::class);

Route::get('/reports', [App\Http\Controllers\ReportsController::class, 'index']);
Route::get('/reports/generate', [App\Http\Controllers\ReportsController::class, 'generate']);
Route::resource('/pricelists', PriceListController::class);
Route::get('/pricelists/toners/{printer}', [PriceListController::class, 'toners']);


Route::get('/customer-portal', [CustomerPortalController::class, 'index']);
Route::post('/customer-portal/results', [CustomerPortalController::class, 'results']);
Route::get('/customer-portal/{id}/{code}', [CustomerPortalController::class, 'welcome']);
Route::get('/toners/{printer}', [CustomerPortalController::class, 'toners']);
Route::post('/customer-portal/{id}/request', [CustomerPortalController::class, 'request']);
Route::get('/dispatch', [DispatchController::class, 'index']);
Route::get('/dispatch/get_requests/{id}', [DispatchController::class, 'get_requests']);
Route::post('/dispatch/{id}/comment', [DispatchController::class, 'post_comment']);
Route::get('/dispatch/{id}/comments', [DispatchController::class, 'get_comments']);
Route::get('/dispatch/{id}/request_dispatch', [DispatchController::class, 'request_dispatch']);
Route::post('/dispatch/{id}/update_dispatch', [DispatchController::class, 'update_dispatch']);



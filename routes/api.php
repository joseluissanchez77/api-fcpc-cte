<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\OrdenCompraController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('user-profile', [AuthController::class, 'userProfile']);
    Route::post('logout', [AuthController::class, 'logout']);

    ///compania
    Route::get('/company', [CompanyController::class, 'index']);
    Route::post('/company', [CompanyController::class, 'store']);
    Route::put('/company/{company}', [CompanyController::class, 'update']);
    Route::delete('/company/{company}', [CompanyController::class, 'destroy']);
    Route::get('/company/{company}', [CompanyController::class, 'show']);

    // //establecimiento
    // Route::get('/establishment', [CompanyController::class, 'index']);
    // Route::post('/establishment', [CompanyController::class, 'store']);
    // Route::put('/establishment/{establishment}', [CompanyController::class, 'update']);
    // Route::delete('/establishment/{establishment}', [CompanyController::class, 'destroy']);
    // Route::get('/establishment/{establishment}', [CompanyController::class, 'show']);
    //productos
    Route::get('/product', [ProductController::class, 'index']);
    Route::post('/product', [ProductController::class, 'store']);
    Route::put('/product/{product}', [ProductController::class, 'update']);
    Route::delete('/product/{product}', [ProductController::class, 'destroy']);
    Route::get('/product/{product}', [ProductController::class, 'show']);


    //clientes
    Route::get('/customer', [CustomerController::class, 'index']);
    Route::post('/customer', [CustomerController::class, 'store']);
    Route::put('/customer/{customer}', [CustomerController::class, 'update']);
    Route::delete('/customer/{customer}', [CustomerController::class, 'destroy']);
    Route::get('/customer/{customer}', [CustomerController::class, 'show']);

    //orden de compra
    Route::get('/establishment-by-company', [OrdenCompraController::class, 'getEstableciemntoByCompania']);
    Route::get('/point_emission-by-establishment', [OrdenCompraController::class, 'getPuntoEmisiionByEstablecimiento']);
});

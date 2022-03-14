<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

Route::get('/company', [CompanyController::class, 'index']);
Route::get('/company/{id}', [CompanyController::class, 'show']);
Route::post('/company', [CompanyController::class, 'store']);
Route::put('/company/{id}', [CompanyController::class, 'update']);
Route::get('/company/{id}/deactivate', [CompanyController::class, 'deactivate']);
Route::get('/company/{id}/restore', [CompanyController::class, 'restore']);
Route::delete('/company/{id}', [CompanyController::class, 'destroy']);

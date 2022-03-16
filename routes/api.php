<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Auth\Middleware\Authenticate;


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

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/company', [CompanyController::class, 'index']);
Route::get('/company/{id}', [CompanyController::class, 'show']);

Route::get("/users", [UserController::class, 'index']);
Route::get("/user/{id}", [UserController::class, 'show']);

Route::group(["middleware" => ['auth:sanctum']], function(){
    Route::name('company')->group(function() {
        Route::post('/', [CompanyController::class, 'store']);
        Route::put('/{id}', [CompanyController::class, 'update']);
        Route::get('/deactivate/{id}', [CompanyController::class, 'deactivate']);
        Route::get('/restore/{id}', [CompanyController::class, 'restore']);
        Route::delete('/{id}', [CompanyController::class, 'destroy']);
    });
    Route::name('user')->group(function(){
        Route::get("/user", [AuthenticatedSessionController::class, 'get']);
        Route::put("/update/{id}", [UserController::class, 'update']);
        Route::put("/deactivate/{id}", [UserController::class, 'deactivate']);
        Route::put("/reactivate/{id}", [UserController::class, 'reactivate']);
        Route::delete("/{id}", [UserController::class, 'destroy']);
    });
    Route::name('review')->group(function(){
        Route::post("/save", [ReviewController::class, 'store']);
        Route::post("/show/{id}", [ReviewController::class, 'show']);
    });
});

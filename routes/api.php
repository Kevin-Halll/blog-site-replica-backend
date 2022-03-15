<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
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

Route::get("/users", [UserController::class, 'index']);
Route::get("/user/{id}", [UserController::class, 'show']);

Route::group(["middleware" => ['auth:sanctum']], function(){
    Route::get("/user", [AuthenticatedSessionController::class, 'get']);
    Route::put("/update/{id}", [UserController::class, 'update']);
    Route::put("/user/deactivate/{id}", [UserController::class, 'deactivate']);
    Route::put("/user/reactivate/{id}", [UserController::class, 'reactivate']);
    Route::delete("/user/delete/{id}", [UserController::class, 'destroy']);
});
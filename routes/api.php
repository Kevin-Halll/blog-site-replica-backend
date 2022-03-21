<?php

use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\CompanyController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyAddressController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\UserController;

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

Route::post('/register', [ApiAuthController::class, 'register']);

Route::get('/company', [CompanyController::class, 'index']);
Route::get('/company/{company}', [CompanyController::class, 'show']);

Route::get('/u/{id}', [UserController::class, 'show'])->middleware('auth:api');
Route::put("/update/{id}", [UserController::class, 'update'])->middleware('auth:api');

Route::get("/users", [UserController::class, 'index']);
Route::get("/user/{id}", [UserController::class, 'show']);

Route::get("/user/review/{id}", [UserController::class, 'reviews']);
Route::get("/company/review/{id}", [CompanyController::class, 'reviews']);

Route::get("/company/address", [CompanyAddressController::class, 'index']);
Route::get("/company/address/{companyAddress}", [CompanyAddressController::class, 'show']);

Route::get("/user/address", [UserAddressController::class, 'index']);
Route::get("/user/address/{userAddress}", [UserAddressController::class, 'show']);

Route::group(["middleware" => ['auth:sanctum']], function () {
    Route::prefix('auth')->group(function() {
        
    });

    Route::prefix('company')->group(function () {
        Route::post('/create', [CompanyController::class, 'store']);
        Route::put('/update/{company}', [CompanyController::class, 'update']);
        Route::put('/deactivate/{company}', [CompanyController::class, 'deactivate']);
        Route::put('/restore/{company}', [CompanyController::class, 'restore']);
        Route::delete('/delete{company}', [CompanyController::class, 'destroy']);
    });
    Route::prefix('user')->group(function () {
        Route::get("/", [AuthenticatedSessionController::class, 'get']);
        Route::put("/update/{id}", [UserController::class, 'update']);
        Route::put("/deactivate/{id}", [UserController::class, 'deactivate']);
        Route::put("/reactivate/{id}", [UserController::class, 'reactivate']);
        Route::delete("/{id}", [UserController::class, 'destroy']);
    });
    Route::prefix('review')->group(function () {
        Route::post("/save", [ReviewController::class, 'store']);
        Route::post("/show/{id}", [ReviewController::class, 'show']);
        Route::put("/update/{id}", [ReviewController::class, 'update']);
        Route::delete("/deactivate/{id}", [ReviewController::class, 'delete']);
        Route::delete("/delete/{id}", [ReviewController::class, 'destroy']);
    });
    Route::prefix("company/address")->group(function () {
        Route::post("/create", [CompanyAddressController::class, 'store']);
        Route::put("/update/{companyAddress}", [CompanyAddressController::class, 'update']);
        Route::delete("/delete/{companyAddress}", [CompanyAddressController::class, 'destroy']);
    });
});

<?php

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

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\WorkspaceController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\BookingController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::get('me', [AuthController::class, 'me']);

Route::middleware('jwt.verify')->group(function () {
    Route::get('users', [AuthController::class, 'users']);

    Route::get('get_modules', [ModuleController::class, 'get_modules']);

    Route::apiResource('customers', CustomerController::class);

    Route::apiResource('workspaces', WorkspaceController::class);

    Route::apiResource('facilities', FacilityController::class);

    Route::apiResource('conferences', ConferenceController::class);

    Route::apiResource('bookings', BookingController::class);
});

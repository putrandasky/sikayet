<?php

use App\Http\Controllers;
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

Route::get('/users', [Controllers\Admin\UserController::class, 'index']);
Route::patch('/user/{user_id}', [Controllers\Admin\UserController::class, 'update']);
Route::get('/companies/{condition}', [Controllers\Admin\CompanyController::class, 'index']);
Route::patch('/company/{company_id}', [Controllers\Admin\CompanyController::class, 'update']);
Route::get('/reviews/{condition}', [Controllers\Admin\ReviewController::class, 'index']);
Route::patch('/review/{review_id}', [Controllers\Admin\ReviewController::class, 'update']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SystemSettingsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/auth", [AuthController::class, 'checkUser']);
Route::get('categories', [CategoriesController::class, 'get']);
Route::get('products', [ProductsController::class, 'get']);
Route::group(['middleware' => "userToken"], function () {
    Route::post('add-product', [ProductsController::class, 'insert']);
    Route::post('update-profile', [ProfileController::class, 'update']);
    Route::post('update-password', [ProfileController::class, 'updatePassword']);
    Route::post('get-branches', [BranchesController::class, 'get']);
    Route::post('add-branch', [BranchesController::class, 'add']);
    Route::post('delete-branch', [BranchesController::class, 'delete']);
    Route::post('get-settings', [SystemSettingsController::class, 'get']);
});

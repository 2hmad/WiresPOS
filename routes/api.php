<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\IngredientsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\SystemSettingsController;
use App\Http\Controllers\TablesController;
use App\Models\Categories;
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

Route::post("auth", [AuthController::class, 'checkUser']);
Route::post("register", [AuthController::class, 'register']);
Route::get('categories', [CategoriesController::class, 'get']);
Route::get('get-products/{category_id}', [CategoriesController::class, 'getProducts']);
Route::get('get-category/{id}', function ($id) {
    return Categories::where('id', $id)->first();
});
Route::group(['middleware' => "userToken"], function () {
    Route::post('products', [ProductsController::class, 'get']);
    Route::post('search', [SearchController::class, 'search']);

    Route::post('tables', [TablesController::class, 'get']);
    Route::post('add-table', [TablesController::class, 'add']);
    Route::post('delete-table', [TablesController::class, 'delete']);

    Route::post('create-invoice', [InvoicesController::class, 'create']);
    Route::post('invoice', [InvoicesController::class, 'get']);
    Route::post('refund-invoice', [InvoicesController::class, 'refund']);
    Route::post('invoices', [InvoicesController::class, 'getAll']);

    Route::post('revenue/{range}', [InvoicesController::class, 'revenue']);
    Route::post('monthly-invoices', [InvoicesController::class, 'monthly_invoices']);
    Route::post('revenue-statistics', [InvoicesController::class, 'revenue_statistics']);

    Route::post('add-product', [ProductsController::class, 'insert']);
    Route::post('delete-product', [ProductsController::class, 'delete']);
    Route::post('add-category', [ProductsController::class, 'add_category']);
    Route::post('edit-category', [ProductsController::class, 'edit_category']);
    Route::post('delete-category', [ProductsController::class, 'delete_category']);

    Route::post('update-profile', [ProfileController::class, 'update']);
    Route::post('update-password', [ProfileController::class, 'updatePassword']);

    Route::post('get-branches', [BranchesController::class, 'get']);
    Route::post('add-branch', [BranchesController::class, 'add']);
    Route::post('delete-branch', [BranchesController::class, 'delete']);

    Route::post('get-settings', [SystemSettingsController::class, 'get']);
    Route::post('update-settings', [SystemSettingsController::class, 'update']);

    Route::post('add-user', [PermissionsController::class, 'add_user']);
    Route::post('get-users', [PermissionsController::class, 'get_users']);
    Route::post('delete-user', [PermissionsController::class, 'delete_user']);

    Route::post('get-store', [StoreController::class, 'get']);
    Route::post('update-store', [StoreController::class, 'update']);

    Route::post('all-ingredients', [IngredientsController::class, 'getAll']);
    Route::post('ingredient', [IngredientsController::class, 'get']);
    Route::post('add-ingredient', [IngredientsController::class, 'add']);
    Route::post('delete-ingredient', [IngredientsController::class, 'delete']);
});

<?php

use App\Http\Controllers\Dashboard\AdminsController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\ImportProductsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;

Route::group([
    'middleware' => ['auth:admin'],
    'as' => 'dashboard.',
    'prefix' => 'admin/dashboard',
], function ()
{
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile','edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
    });

    Route::controller(CategoriesController::class)->group(function () {
        Route::get('/categories/trash', 'trash')->name('categories.trash');
        Route::put('/categories/{category}/restore', 'restore')->name('categories.restore');
        Route::delete('/categories/{category}/force-delete', 'forceDelete')->name('categories.force-delete');
    });
    Route::resource('/categories', CategoriesController::class);

    Route::controller(ProductController::class)->group(function () {
        Route::get('/products/trash', 'trash')->name('products.trash');
        Route::put('/products/{product}/restore', 'restore')->name('products.restore');
        Route::delete('/products/{product}/force-delete', 'forceDelete')->name('products.force-delete');
    });

    Route::controller(ImportProductsController::class)->group(function () {
        Route::get('/products/import', 'create')->name('products.import');
        Route::post('/products/import', 'store');
    });

    Route::resource('/products', ProductController::class);
    Route::resource('/roles', RolesController::class);
    Route::resource('/admins', AdminsController::class);
    Route::resource('/users', UsersController::class);
});

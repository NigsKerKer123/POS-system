<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\productsController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\AddUserController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    'auth',
    InitializeTenancyBySubdomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

    //upgrade
    Route::post('/upgrade', [adminController::class, 'upgrade'])->name('upgrade');

    //Product API Route
    Route::controller(productsController::class)->group(function () {
        Route::get('/products', 'index')->name('products.index');
        Route::post('/products/add', 'add')->name('products.add');
        Route::put('/products/edit', 'edit')->name('products.edit');
        Route::delete('/products/delete', 'delete')->name('products.delete');
    });

    //Category API Route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('category.index');
        Route::post('/category/add', 'add')->name('category.add');
        Route::put('/category/edit', 'edit')->name('category.edit');
        Route::delete('/category/delete', 'delete')->name('category.delete');
    });

    //inventory API Route
    Route::controller(InventoryController::class)->group(function () {
        Route::get('/inventory', 'index')->name('inventory.index');
        Route::post('/inventory/add', 'add')->name('inventory.add');
        Route::put('/inventory/edit', 'edit')->name('inventory.edit');
        Route::delete('/inventory/delete', 'delete')->name('inventory.delete');
    });

    //sales API Route
    Route::controller(SalesController::class)->group(function () {
        Route::get('/sales', 'index')->name('sales.index');
        Route::post('/sales/add', 'add')->name('sales.add');
        Route::put('/sales/edit', 'edit')->name('sales.edit');
        Route::delete('/sales/delete', 'delete')->name('sales.delete');
    });

    //Settings API routes
    Route::controller(SettingsController::class)->group(function () {
        Route::get('/settings', 'index')->name('settings.index');
        Route::post('/settings/customize', 'customize')->name('settings.customize');
        Route::put('/settings/changePassword', 'changePass')->name('settings.changePass');
    });

    //Add User API routes
    Route::controller(AddUserController::class)->group(function () {
        Route::get('/addUser', 'index')->name('addUser.index');
        Route::post('/addUser/add', 'add')->name('addUser.add');
        Route::put('/addUser/edit', 'edit')->name('addUser.edit');
        Route::delete('/addUser/delete', 'delete')->name('addUser.delete');
    });
});

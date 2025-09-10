<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::prefix('admin')->middleware(['auth', 'verified'])->name('admin.')->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('Admin/Dashboard/Index');
    })->name('dashboard');

    Route::prefix('master')->name('master.')->group(function () {

        Route::get('provinces', \App\Http\Controllers\Admin\Master\ProvinceController::class)->name('provinces.index');

        Route::get('cities', \App\Http\Controllers\Admin\Master\CityController::class)->name('cities.index');

        Route::get('subdistricts', \App\Http\Controllers\Admin\Master\SubdistrictController::class)->name('subdistricts.index');

        Route::get('titles', \App\Http\Controllers\Admin\Master\TitleController::class)->name('titles.index');

        Route::get('identities', \App\Http\Controllers\Admin\Master\IdentityController::class)->name('identities.index');

        Route::get('relationships', \App\Http\Controllers\Admin\Master\RelationshipController::class)->name('relationships.index');

        Route::get('payments', \App\Http\Controllers\Admin\Master\PaymentMethodController::class)->name('payments.index');
    });

    Route::prefix('management')->name('management.')->group(function () {

        Route::resource('roles', \App\Http\Controllers\Admin\Management\RoleController::class);

        Route::resource('permissions', \App\Http\Controllers\Admin\Management\PermissionController::class);

        Route::resource('users', \App\Http\Controllers\Admin\Management\UserController::class);
    });

    Route::prefix('products')->name('products.')->group(function () {

        Route::resource('clusters', \App\Http\Controllers\Admin\Products\ClusterController::class);

        Route::prefix('clusters')->name('clusters.')->group(function () {
            Route::resource('{cluster}/blocks', \App\Http\Controllers\Admin\Products\BlockController::class);
        });

        Route::resource('types', \App\Http\Controllers\Admin\Products\TypeController::class);

        Route::resource('graves', \App\Http\Controllers\Admin\Products\GraveController::class);

        Route::post('graves/count', [\App\Http\Controllers\Admin\Products\GraveController::class, 'getNumberOfGraves'])->name('graves.count');
    });

    require __DIR__ . '/settings.php';
});
require __DIR__ . '/auth.php';

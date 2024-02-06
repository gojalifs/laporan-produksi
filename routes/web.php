<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->name('index');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware(['user'])->group(function () {
        Route::get('produksi', [ProductionController::class, 'index'])->name('production');
        Route::post('produksi/add', [ProductionController::class, 'create'])->name('production.add');
        Route::get('profile', [UserController::class, 'updateUserIndex'])->name('user-profile');
        Route::post('profile', [UserController::class, 'updateUser'])->name('profile-update');
    });

    Route::middleware(['admin'])->group(function () {
        Route::get('laporan', [ProductionController::class, 'report'])->name('production.report');
        Route::post('laporan', [ProductionController::class, 'reportByDate'])->name('production.report_daily');

        Route::get('employees', [UserController::class, 'index'])->name('employees');
        Route::post('add_employee', [UserController::class, 'store'])->name('employee.add');
        Route::get('employee/update/{id}', [UserController::class, 'updateIndex'])->name('employee.update_data');
        Route::post('employee/update', [UserController::class, 'update'])->name('employee.update');
        Route::delete('employee/delete/{id}', [UserController::class, 'destroy'])->name('employee.delete');

        Route::get('products', [ProductController::class, 'index'])->name('product');
        Route::post('products/add', [ProductController::class, 'create'])->name('product.add');
        Route::get('products/update/{id}', [ProductController::class, 'updateIndex'])->name('product.update_data');
        Route::post('products/update', [ProductController::class, 'update'])->name('product.update');
        Route::delete('products/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

        Route::get('barcode', [BarcodeController::class, 'index'])->name('barcode');
        Route::post('barcode/generate', [BarcodeController::class, 'generate'])->name('barcode.generate');
        Route::get('barcode/generated', [BarcodeController::class, 'generated'])->name('barcode.generated');
    });
});

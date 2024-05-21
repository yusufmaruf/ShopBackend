<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',

// ])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::group([
    'middleware' => 'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
], function () {
    Route::name('dashboard.')->prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::middleware(['admin'])->group(function () {
            Route::resource('category', ProductCategoryController::class);
        });
    });
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserTableController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\Role\RoleTableController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\CompanyTableController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Employee\EmployeeTableController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\VerificationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/task', function () {
    return view('welcome');
});

Auth::routes(['logout' => false,
'verify' => true]);
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
    
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'prefix' => 'auth',
    'as' => 'admin.auth.',
    'namespace' => 'Auth',
    'middleware' => 'auth',
], function () {
    // User Management
    Route::group(['namespace' => 'User'], function () {
        // For DataTables
        Route::post('user/get', [UserTableController::class, 'invoke'])->name('user.get');


        // User CRUD
        Route::get('user', [UserController::class, 'index'])->name('user.index');
        Route::get('user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('user', [UserController::class, 'store'])->name('user.store');
        Route::group(['prefix' => 'user/{user}'], function () {
            Route::get('/edit', [UserController::class, 'edit'])->name('user.edit');
            Route::patch('/edit', [UserController::class, 'update'])->name('user.update');
            Route::delete('/delete', [UserController::class, 'destroy'])->name('user.destroy');
            Route::get('/show', [UserController::class, 'show'])->name('user.show');

        });
    });

    Route::group(['namespace' => 'Role', 'prefix' => 'role'], function () {
        // For DataTables
        Route::post('/get', [RoleTableController::class, 'invoke'])->name('role.get');


        // Role CRUD
        Route::get('/', [RoleController::class, 'index'])->name('role.index');
        Route::get('/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/', [RoleController::class, 'store'])->name('role.store');
        Route::group(['prefix' => '{role}'], function () {
            Route::get('/edit', [RoleController::class, 'edit'])->name('role.edit');
            Route::patch('/edit', [RoleController::class, 'update'])->name('role.update');
            Route::delete('/delete', [RoleController::class, 'destory'])->name('role.destroy');
            Route::get('/show', [RoleController::class, 'show'])->name('role.show');

        });
    });

    
});
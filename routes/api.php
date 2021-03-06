<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PassportAuthController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\ApprovalController;
use App\Http\Controllers\API\CommentController;
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

Route::post('register', [PassportAuthController::class, 'register'])->name('api.register');
Route::post('login', [PassportAuthController::class, 'login'])->name('api.login');
Route::post('logout', [PassportAuthController::class, 'logout'])->name('api.logout');

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('logout', [PassportAuthController::class, 'logout'])->name('api.logout');
    // Role
    Route::group(['prefix' => 'role'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('api.role.index');
        Route::post('/create', [RoleController::class, 'store'])->name('api.role.store');
        Route::group(['prefix' => '{role}'], function () {
            Route::post('/edit', [RoleController::class, 'update'])->name('api.role.update');
            Route::delete('/delete', [RoleController::class, 'destory'])->name('api.role.destory');
        });
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index'])->name('api.user.index');
        Route::post('/create', [UserController::class, 'store'])->name('api.user.store');
        Route::group(['prefix' => '{user}'], function () {
            Route::get('/show', [UserController::class, 'show'])->name('api.user.show');
            Route::post('/edit', [UserController::class, 'update'])->name('api.user.update');
            Route::delete('/delete', [UserController::class, 'destory'])->name('api.user.destory');
        });
    });

    Route::group(['prefix' => 'post'], function () {
        Route::get('/', [PostController::class, 'index'])->name('api.post.index');
        Route::post('/create', [PostController::class, 'store'])->name('api.post.store');
        Route::group(['prefix' => '{post}'], function () {
            Route::post('/edit', [PostController::class, 'update'])->name('api.post.update');
            Route::delete('/delete', [PostController::class, 'destory'])->name('api.post.destory');
        });
    });

    Route::group(['prefix' => 'post-approval'], function () {
        Route::get('/', [ApprovalController::class, 'index'])->name('api.post.approval.index');
        Route::post('/filter', [ApprovalController::class, 'filter'])->name('api.post.approval.filter');
        Route::group(['prefix' => '{post}'], function () {
            Route::post('/edit', [ApprovalController::class, 'update'])->name('api.post.approval.update');
        });
    });

    Route::group(['prefix' => 'comment'], function () {
        Route::post('/', [CommentController::class, 'reply'])->name('api.comment.reply');
        Route::post('/add', [CommentController::class, 'comment'])->name('api.comment.add');
        Route::get('/view', [CommentController::class, 'view'])->name('api.comment.view');
        Route::post('/update', [CommentController::class, 'updateComment'])->name('api.comment.update-comment');
        Route::delete('/delete', [PostController::class, 'destory'])->name('api.comment.destory');
    });


});

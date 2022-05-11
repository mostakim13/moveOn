<?php

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;



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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'auth'], 'namespace' => 'Admin'], function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::group(['prefix' => 'user', 'middleware' => ['user', 'auth'], 'namespace' => 'User'], function () {
    Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/page/create', [UserController::class, 'createPage'])->name('create-page');
    Route::post('/page/create/store', [UserController::class, 'storePage'])->name('store-page');

    Route::get('/page/{pageId}/attach-post', [UserController::class, 'pagePost'])->name('page-post');
    Route::post('/page/attach-post/store', [UserController::class, 'pagePostStore'])->name('page-post-store');



    Route::get('/person/attach-post', [UserController::class, 'attachPost'])->name('attach-post');
    Route::post('/person/attach-post/store', [UserController::class, 'storePost'])->name('store-post');


    Route::post('follow/person', [UserController::class, 'followPerson'])->name('follow-person');
    Route::post('follow/page', [UserController::class, 'followPage'])->name('follow-page');
});
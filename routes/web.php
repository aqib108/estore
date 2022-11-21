<?php

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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/run-cmd', function () {
    Artisan::call('schedule:run');
    dump('Running');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);


// Authentication Routes...
Route::get('admin', [App\Http\Controllers\Auth\Admin\LoginController::class, 'login'])->name('admin.auth.login');

Route::post('admin', [App\Http\Controllers\Auth\Admin\LoginController::class, 'loginAdmin'])->name('admin.auth.loginAdmin');

Route::any('admin/logout', [App\Http\Controllers\Auth\Admin\LoginController::class, 'logout'])->name('admin.auth.logout');


Route::prefix('admin')->namespace('Admin')->group(static function() 
{
    Route::middleware('auth:admin')->group(static function () 
    {
    	Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('admins', '\App\Http\Controllers\Admin\AdminController');
        Route::get('profile', '\App\Http\Controllers\Admin\AdminController@profile');
        Route::post('profile', '\App\Http\Controllers\Admin\AdminController@profile');
        Route::resource('roles', '\App\Http\Controllers\Admin\RoleController');
        Route::resource('customers', '\App\Http\Controllers\Admin\CustomerController');
        Route::resource('site-setting', '\App\Http\Controllers\Admin\SettingController');
        Route::resource('categories', '\App\Http\Controllers\Admin\CategoriesController');
        Route::resource('tags', '\App\Http\Controllers\Admin\TagsController');
        Route::resource('posts', '\App\Http\Controllers\Admin\PostsController');
        Route::resource('pages', '\App\Http\Controllers\Admin\PagesController');
        Route::post('pages/uploadimage', '\App\Http\Controllers\Admin\PagesController@uploadimage')->name('admin.pages.uploadimage');
        Route::post('posts/uploadimage', '\App\Http\Controllers\Admin\PostsController@uploadimage')->name('admin.posts.uploadimage');
    });
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/assigment', [App\Http\Controllers\HomeController::class, 'assigment'])->name('assigment');

Route::get('/{slug}', [App\Http\Controllers\HomeController::class, 'page'])->name('page');
Route::get('post/{slug}', [App\Http\Controllers\HomeController::class, 'post'])->name('post');
Route::get('category/{slug}', [App\Http\Controllers\HomeController::class, 'category'])->name('category');
Route::get('tag/{slug}', [App\Http\Controllers\HomeController::class, 'tag'])->name('tag');
Route::get('search/query', [App\Http\Controllers\HomeController::class, 'search'])->name('search');

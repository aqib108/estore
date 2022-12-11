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
Route::post('/set-local', [App\Http\Controllers\HomeController::class, 'setLocal']);
Route::post('/subscription', [App\Http\Controllers\HomeController::class, 'subscription']);
Route::post('/contact_us', [App\Http\Controllers\HomeController::class, 'Contact_us']);
Route::get('/library-tabs', [App\Http\Controllers\HomeController::class, 'librarySections'])->name('library.tabs');

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
        Route::resource('sliders', '\App\Http\Controllers\Admin\SliderController');
        Route::resource('courses', '\App\Http\Controllers\Admin\CourseController');
        Route::resource('ceomessage', '\App\Http\Controllers\Admin\CeoMessageController');
        Route::resource('testimonials', '\App\Http\Controllers\Admin\TestimonialController');
        Route::post('pages/uploadimage', '\App\Http\Controllers\Admin\PagesController@uploadimage')->name('admin.pages.uploadimage');
        Route::post('posts/uploadimage', '\App\Http\Controllers\Admin\PostsController@uploadimage')->name('admin.posts.uploadimage');
        Route::post('sliders/uploadimage', '\App\Http\Controllers\Admin\SliderController@uploadimage')->name('admin.sliders.uploadimage');
        Route::resource('department', '\App\Http\Controllers\Admin\DepartmentController');
        Route::resource('contacts', '\App\Http\Controllers\Admin\ContactController');
        Route::get('/contacts-status', [App\Http\Controllers\Admin\ContactController::class, 'updateStatus']);
        Route::resource('subscriptions', '\App\Http\Controllers\Admin\SubscriptionController');
        Route::resource('donations', '\App\Http\Controllers\Admin\DonationController');
        Route::resource('news', '\App\Http\Controllers\Admin\NewsController');
        Route::get('featured-donation/{id}', [App\Http\Controllers\Admin\DonationController::class, 'setFeaturedDonation'])->name('admin.featured.donation');
        Route::resource('magazine-categories', '\App\Http\Controllers\Admin\MagazineCategoryController');
        Route::resource('magazines', '\App\Http\Controllers\Admin\MagazineController');
        Route::resource('locations', '\App\Http\Controllers\Admin\LocationController');
        Route::get('locations/featured-address/{id}', '\App\Http\Controllers\Admin\LocationController@setFeaturedAddress');
        //library route
        Route::post('save-files-ajax/{libId}', '\App\Http\Controllers\Admin\LibraryController@saveFilesAjax');
        Route::resource('library', '\App\Http\Controllers\Admin\LibraryController');
        Route::resource('classes', '\App\Http\Controllers\Admin\ClassesController');
        Route::post('update-thumb-img/{id}', '\App\Http\Controllers\Admin\LibraryController@updateThumbImg');
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

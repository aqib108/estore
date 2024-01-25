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

Route::get('/storage', function () {
    Artisan::call('storage:link');
    dump('storage linked');
});
//ecommerce store route
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/get-products', [App\Http\Controllers\HomeController::class, 'getProducts']);
//end of ecommerce store route


Route::get('/blog', [App\Http\Controllers\HomeController::class, 'Blog']);
Route::get('/blog-detail/{id?}', [App\Http\Controllers\HomeController::class, 'BlogDetail'])->name('home.blog-detail');
Route::get('/news-events', [App\Http\Controllers\HomeController::class, 'News']);
Route::get('/news-event/{id?}', [App\Http\Controllers\HomeController::class, 'NewsDetail'])->name('home.news-events-detail');
Route::get('/library/{id?}', [App\Http\Controllers\HomeController::class, 'LibraryDetail'])->name('home.library');
Route::get('/magazine-categories', [App\Http\Controllers\HomeController::class, 'MagzineCategories'])->name('home.magazine.categories');
Route::get('/magazine-category-detail/{id?}', [App\Http\Controllers\HomeController::class, 'MagzineDetail'])->name('home.magazine.detail');
Route::get('/courses', [App\Http\Controllers\HomeController::class, 'courses'])->name('home.courses');
Route::get('/classes/{id?}', [App\Http\Controllers\HomeController::class, 'classes'])->name('home.classes');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::post('/set-local', [App\Http\Controllers\HomeController::class, 'setLocal']);
Route::post('/subscription', [App\Http\Controllers\HomeController::class, 'subscription']);
Route::get('/contact_us', [App\Http\Controllers\HomeController::class, 'Contactus'])->name('contact_us');
Route::post('/save_contact_us', [App\Http\Controllers\HomeController::class, 'SaveContactus']);
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
        Route::post('update-pic', '\App\Http\Controllers\Admin\AdminController@profilePic');
        Route::resource('customers', '\App\Http\Controllers\Admin\CustomerController');
        Route::post('pages/uploadimage', '\App\Http\Controllers\Admin\PagesController@uploadimage')->name('admin.pages.uploadimage');
        Route::post('posts/uploadimage', '\App\Http\Controllers\Admin\PostsController@uploadimage')->name('admin.posts.uploadimage');
        Route::post('sliders/uploadimage', '\App\Http\Controllers\Admin\SliderController@uploadimage')->name('admin.sliders.uploadimage');
        Route::get('/contacts-status', [App\Http\Controllers\Admin\ContactController::class, 'updateStatus']);
        Route::get('featured-donation/{id}', [App\Http\Controllers\Admin\DonationController::class, 'setFeaturedDonation'])->name('admin.featured.donation');
        Route::get('locations/featured-address/{id}', '\App\Http\Controllers\Admin\LocationController@setFeaturedAddress');
        //library route
        Route::post('save-files-ajax/{libId}', '\App\Http\Controllers\Admin\LibraryController@saveFilesAjax');
        Route::post('update-thumb-img/{id}', '\App\Http\Controllers\Admin\LibraryController@updateThumbImg');

        Route::any('donation/recieved-amount', [\App\Http\Controllers\Admin\DonationController::class, 'recievedAmount'])->name('admin.donation-recieved-amount');
        Route::resource('document-uploader', '\App\Http\Controllers\Admin\DocumentUploader');
        //rooms route
        Route::resource('categories', '\App\Http\Controllers\Admin\CategoriesController');
        // Route::resource('customers', '\App\Http\Controllers\Admin\RoomCustomerController');
        Route::resource('room-booking', '\App\Http\Controllers\Admin\RoomBookingController');
        Route::get('booking-invoice\{id?}','\App\Http\Controllers\Admin\RoomBookingController@printInvoice')->name('admin.print.invoice');

        Route::resource('products', '\App\Http\Controllers\Admin\ProductsController');
        Route::resource('offers', '\App\Http\Controllers\Admin\OfferController');
        Route::get('products/featured-offer/{id}', '\App\Http\Controllers\Admin\ProductsController@setFeaturedOffer');
        Route::post('product-post', [\App\Http\Controllers\Admin\ProductsController::class, 'productPost'])->name('admin.product-post');
        Route::get('products/featured-product/{id}', '\App\Http\Controllers\Admin\ProductsController@setFeaturedProduct');
        //end of rooms route
    });
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/assigment', [App\Http\Controllers\HomeController::class, 'assigment'])->name('assigment');

// Route::get('/{slug}', [App\Http\Controllers\HomeController::class, 'page'])->name('page');
Route::get('post/{slug}', [App\Http\Controllers\HomeController::class, 'post'])->name('post');
Route::get('category/{slug}', [App\Http\Controllers\HomeController::class, 'category'])->name('category');
Route::get('tag/{slug}', [App\Http\Controllers\HomeController::class, 'tag'])->name('tag');
Route::get('search/query', [App\Http\Controllers\HomeController::class, 'search'])->name('search');
Route::get('/download/{document_id?}', [App\Http\Controllers\HomeController::class, 'downloadFile'])->name('download-file');

Route::prefix('user')->namespace('user')->group(static function () {
    Route::middleware('auth')->group(function () {

        Route::get('/dashboard', [App\Http\Controllers\User\DashboardController::class, 'dashboard'])->name('user.dashboard');

    });
});


// Route::get('/news',function(){
//     return view('home.pages.news-detail');
// });
// Route::get('/library',function(){
//     return view('home.pages.library-detail');
// });
// Route::get('/magzine',function(){
//     return view('home.pages.magzine-detail');
// });
// Route::get('/blog', [App\Http\Controllers\HomeController::class, 'BlogDetail']);
// Route::get('/news', [App\Http\Controllers\HomeController::class, 'NewsDetail'])->name('news');
// Route::get('/library', [App\Http\Controllers\HomeController::class, 'LibraryDetail'])->name('library');
// Route::get('/magzine', [App\Http\Controllers\HomeController::class, 'MagzineDetail'])->name('magzine');

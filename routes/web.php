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
Route::get('/get-products', [App\Http\Controllers\HomeController::class, 'getProducts'])->name('get.products');
Route::get('/products/{sku?}', [App\Http\Controllers\HomeController::class, 'getProductsDetailPage'])->name('get.product.detail');
Route::get('/contact-us', [App\Http\Controllers\HomeController::class, 'Contactus'])->name('contact_us');
Route::get('/about-us', [App\Http\Controllers\HomeController::class, 'Aboutus'])->name('about_us');
Route::get('/services', [App\Http\Controllers\HomeController::class, 'ServicesPage'])->name('services');
Route::get('/issue-booking', [App\Http\Controllers\HomeController::class, 'IssueBookingPage'])->name('issue.booking.page');
Route::post('/save-issue-booking', [App\Http\Controllers\HomeController::class, 'SaveIssueBooking'])->name('issue.booking.save');

Route::post('/save_contact_us', [App\Http\Controllers\HomeController::class, 'SaveContactus']);

//offers
Route::get('/offers', [App\Http\Controllers\HomeController::class, 'offerLists'])->name('offer.list');
Route::get('/offer/{sku?}', [App\Http\Controllers\HomeController::class, 'getOfferDetailPage'])->name('get.offer.detail');
//end of offers
Route::middleware('auth')->group(function(){
    Route::post('/remove-to-cart', [App\Http\Controllers\CartController::class, 'RemoveToCart']);
    Route::post('/update-cart-qty', [App\Http\Controllers\CartController::class, 'updateCartQty']);
    Route::post('/add-to-cart', [App\Http\Controllers\CartController::class, 'AddToCart']);
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'cartList'])->name('cart.list');
    Route::get('/account', [App\Http\Controllers\AccountController::class, 'getAccountPage'])->name('account.profile');
});
//end of ecommerce store route





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
        Route::post('update-pic', '\App\Http\Controllers\Admin\AdminController@profilePic');
        Route::resource('customers', '\App\Http\Controllers\Admin\CustomerController');
        Route::post('pages/uploadimage', '\App\Http\Controllers\Admin\PagesController@uploadimage')->name('admin.pages.uploadimage');
        Route::get('/contacts-status', [App\Http\Controllers\Admin\ContactController::class, 'updateStatus']);
        //rooms route
        Route::resource('categories', '\App\Http\Controllers\Admin\CategoriesController');
        // Route::resource('customers', '\App\Http\Controllers\Admin\RoomCustomerController');

        Route::resource('products', '\App\Http\Controllers\Admin\ProductsController');
        Route::resource('offers', '\App\Http\Controllers\Admin\OfferController');
        Route::get('products/featured-offer/{id}', '\App\Http\Controllers\Admin\ProductsController@setFeaturedOffer');
        Route::post('product-post', [\App\Http\Controllers\Admin\ProductsController::class, 'productPost'])->name('admin.product-post');
        Route::get('products/featured-product/{id}', '\App\Http\Controllers\Admin\ProductsController@setFeaturedProduct');
        Route::resource('site-setting', '\App\Http\Controllers\Admin\SettingController');
        Route::resource('orders', '\App\Http\Controllers\Admin\OrdersController');
        Route::get('order-details', '\App\Http\Controllers\Admin\OrdersController@orderDetails');
        Route::get('order-change-status', '\App\Http\Controllers\Admin\OrdersController@updateOrderStatus');
        //end of rooms route
    });
});



Auth::routes();

Route::prefix('user')->namespace('user')->group(static function () {
    Route::middleware('auth')->group(function () {

        Route::get('/dashboard', [App\Http\Controllers\User\DashboardController::class, 'dashboard'])->name('user.dashboard');
        Route::get('/order', [App\Http\Controllers\HomeController::class, 'checkoutPage'])->name('order');
        Route::post('/save-order', [App\Http\Controllers\HomeController::class, 'saveOrder'])->name('save.order');

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

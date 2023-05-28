<?php

use App\Http\Controllers\Backend\ArticleController as BackendArticleController;
use App\Http\Controllers\Backend\ArticleGroupController;
use App\Http\Controllers\Backend\CategoryController as BackendCategoryController;
use App\Http\Controllers\Backend\CustomerController as BackendCustomerController;
use App\Http\Controllers\Backend\OrderController as BackendOrderController;
use App\Http\Controllers\Backend\ProductController as BackendProductController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\SystemController as BackendSystemController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\ArticleController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CartAjaxController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\CustomerController;
use App\Http\Controllers\Frontend\MailController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\SystemController;
use App\Http\Controllers\Frontend\WishlistContronller;
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

//----------------------------------------Backend----------------------------------------/
Route::get('/admin/login', [UserController::class, 'login'])->name('b.login');
Route::post('/admin/login', [UserController::class, 'loginPost'])->name('b.loginpost');
Route::get('/admin/logout', [UserController::class, 'logout'])->name('b.logout');
Route::get('/admin/403', [BackendSystemController::class, '_403'])->name('b.403');
Route::get('/admin/404', [BackendSystemController::class, '_404'])->name('b.404');

Route::group(
    ['prefix' => '/admin', 'middleware' => ['auth.web', 'role.admin']],
    function () {
        Route::get('/', [BackendSystemController::class, 'index'])->name('b.home');

        Route::get('/user-list', [UserController::class, 'index'])->name('b.userlist');
        Route::get('/deluser/{id}', [UserController::class, 'delete'])->name('b.deluser');
        Route::get('/user-information-edit/{id}', [UserController::class, 'profile'])->name('b.infouser');
        Route::post('/user-information-update/{id}', [UserController::class, 'profile_update'])->name('b.infouser_update');
        Route::get('/user-edit/{id}', [UserController::class, 'edit'])->name('b.useredit');
        Route::post('/user-update/{id}', [UserController::class, 'edit_update'])->name('b.useredit_update');
        Route::get('/user-create', [UserController::class, 'create'])->name('b.createuser');
        Route::post('/user-create', [UserController::class, 'create_action'])->name('b.createuser_action');

        Route::resource('roles', RoleController::class);

        Route::resource('products', BackendProductController::class);

        Route::resource('suppliers', SupplierController::class);

        Route::resource('orders', BackendOrderController::class);

        Route::resource('customers', BackendCustomerController::class);

        Route::resource('articles', BackendArticleController::class);

        Route::resource('articlegroups', ArticleGroupController::class);

        Route::resource('categories', BackendCategoryController::class);
    }
);


//----------------------------------------FrontEnd----------------------------------------//
Route::get('/', [SystemController::class, 'index'])->name('f.home');
Route::get('/404', [SystemController::class, '_404'])->name('f._404');
Route::get('/search', [SystemController::class, 'search'])->name('f.search');

Route::get('/login', [CustomerController::class, 'login'])->name('f.login');
Route::post('/login', [CustomerController::class, 'loginPost'])->name('f.loginpost');
Route::get('/logout', [CustomerController::class, 'logout'])->name('f.logout');
Route::get('/register', [CustomerController::class, 'create'])->name('f.register');
Route::post('/register', [CustomerController::class, 'create_action'])->name('f.registerpost');
Route::get('/profile/{id}', [CustomerController::class, 'profile'])->name('f.profile');
Route::post('/update_profile/{id}', [CustomerController::class, 'update_profile'])->name('f.update_profile');


Route::get('/contact', [MailController::class, 'contact'])->name('f.contact');
Route::post('/contact', [MailController::class, 'sendEmail'])->name('f.send');

Route::get('/blog', [ArticleController::class, 'index'])->name('f.blog');
Route::get('/blog-detail&{id}', [ArticleController::class, 'detail'])->name('f.blogdetail');

Route::get('/cart', [CartAjaxController::class, 'index'])->name('f.shopcart');
Route::post('/add-to-cart-aj/{id}', [CartAjaxController::class, 'addToCart'])->name('f.aj.addcart');
Route::put('/update-cart-aj/{id}', [CartAjaxController::class, 'updateCart'])->name('f.aj.updatecart');
Route::delete('/remove-item-cart-aj/{id}', [CartAjaxController::class, 'removeItemCart'])->name('f.aj.delcart');
Route::delete('/remove-all-item-cart-aj', [CartAjaxController::class, 'removeAllItemCart'])->name('f.aj.delallcart');

Route::get('/checkout', [OrderController::class, 'index'])->name('f.checkout');
Route::post('/addorder', [OrderController::class, 'add_order'])->name('f.addorder');
Route::get('/success/{id}', [OrderController::class, 'success'])->name('f.success_order');
Route::get('/order-status/{id}', [OrderController::class, 'order_status'])->middleware('auth.frontend')->name('f.order_status');
Route::get('/order-detail/{id}', [OrderController::class, 'order_detail'])->middleware('auth.frontend')->name('f.order_detail');

Route::get('/wishlist&{id}', [WishlistContronller::class, 'show'])->middleware('auth.frontend')->name('f.wishlist');
Route::post('/wishlist&{id}', [WishlistContronller::class, 'create'])->middleware('auth.frontend')->name('f.wishlist_create');
Route::delete('/wishlist&{id}', [WishlistContronller::class, 'destroy'])->middleware('auth.frontend')->name('f.wishlist_delete');

Route::get('/category/{id}', [CategoryController::class, 'cate_pro'])->name('f.cate_pro');

Route::get('/shop', [ProductController::class, 'shop'])->name('f.shop');
Route::get('/detail/{a}', [ProductController::class, 'detail'])->name('f.prodetail');

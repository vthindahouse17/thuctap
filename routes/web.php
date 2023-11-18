<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/signup', [AuthController::class, 'postSignup'])->name('postSignup');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('category/{slug}', [CategoryController::class, 'index'])->name('category/{slug}')->where(['slug' => '[a-zA-Z0-9\-]+']);

Route::get('product/{slug}', [ProductController::class, 'detail'])->name('product/{slug}')->where(['slug' => '[a-zA-Z0-9\-]+']);

Route::middleware(['checkaccount'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/change', [CartController::class, 'change'])->name('cart.change');
    Route::post('/cart', [CartController::class, 'changeQty'])->name('cart.changeQty');
    Route::get('/deleteCart/{id}', [CartController::class, 'deleteCart'])->name('cart.delete');
    Route::get('/clearAllCart', [CartController::class, 'clearAllCart'])->name('cart.deleteAll');

    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CartController::class, 'postCheckout'])->name('postCheckout');

    Route::get('/invoice/{id}', [CartController::class, 'invoice'])->name('invoice');
    Route::get('/logout', function () {
        Auth::logout();
        Session::flush();
        return redirect('/login');
    })->name('logout');
});

Route::middleware('checkadmin')->group(function () {
    Route::prefix('admin')->name('admin.')->group(
        function () {
            Route::get('/', [AdminController::class, 'index'])->name('home');
            Route::prefix('category')->group(
                function () {
                    Route::get('/', [CategoryController::class, 'admin'])->name('category');
                    Route::get('add', [CategoryController::class, 'add'])->name('addCategory');
                    Route::post('add', [CategoryController::class, 'postadd'])->name('postAddCategory');
                    Route::get('edit/{id?}', [CategoryController::class, 'edit'])->name('editCategory')->where(['id' => '[0-9]+']);
                    Route::put('edit', [CategoryController::class, 'postedit'])->name('postEditCategory');
                    Route::get('delete/{id?}', [CategoryController::class, 'delete'])->name('deleteCategory')->where(['id' => '[0-9]+']);
                }
            );

            Route::prefix('product')->group(
                function () {
                    Route::get('/', [ProductController::class, 'admin'])->name('product');
                    Route::get('add', [ProductController::class, 'add'])->name('addProduct');
                    Route::post('add', [ProductController::class, 'postadd'])->name('postAddProduct');
                    Route::get('edit/{id?}', [ProductController::class, 'edit'])->name('editProduct')->where(['id' => '[0-9]+']);
                    Route::put('edit', [ProductController::class, 'postedit'])->name('postEditProduct');
                    Route::get('delete/{id?}', [ProductController::class, 'delete'])->name('deleteProduct')->where(['id' => '[0-9]+']);
                }
            );

            Route::prefix('banner')->group(
                function () {
                    Route::get('/', [BannerController::class, 'index'])->name('banner');
                    Route::put('/', [BannerController::class, 'postedit'])->name('postEditBanner');
                }
            );

            Route::prefix('invoice')->group(
                function () {
                    Route::get('/', [InvoiceController::class, 'admin'])->name('invoice');
                    Route::post('/', [InvoiceController::class, 'post'])->name('postEditInvoice');
                }
            );

            Route::prefix('banner')->group(
                function () {
                    Route::get('/', [BannerController::class, 'index'])->name('banner');
                    Route::get('add', [BannerController::class, 'add'])->name('addBanner');
                    Route::post('add', [BannerController::class, 'postadd'])->name('postAddBanner');
                    Route::get('edit/{id?}', [BannerController::class, 'edit'])->name('editBanner')->where(['id' => '[0-9]+']);
                    Route::put('edit', [BannerController::class, 'postedit'])->name('postEditBanner');
                    Route::get('delete/{id?}', [BannerController::class, 'delete'])->name('deleteBanner')->where(['id' => '[0-9]+']);
                }
            );
        }
    );
});

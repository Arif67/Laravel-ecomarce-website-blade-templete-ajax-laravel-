<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartCotroller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\OrderderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserProfileController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

Route::get('/home',[HomePageController::class,'index']);

Route::get('/',[HomePageController::class,'index'])->name('home');

Route::get('/shop',[ShopController::class,'index'])->name('shop');

Route::get('/categoryPage',function(){
    return view('UserSite.userSiteComponent.category');
});
Route::get('/checkout',function(){
    return view('UserSite.userSiteComponent.checkout');
});
Route::get('/contact',function(){
    return view('UserSite.userSiteComponent.Contact');
});
Route::get('/ProductDetails/{id}',[ProductController::class,"ProductDetails"])->name('ProductDetails');
Route::get('/subcategory',function(){
    return view('UserSite.userSiteComponent.subcategory');
});
Route::get('/muster',function(){
    return "hello world ";
});


Auth::routes();







// Category Routes
//Route::resource('/category', CategoryController::class);
Route::get('/category',[CategoryController::class,'index'])->name('category');
Route::post('/category',[CategoryController::class,'store']);
Route::put('/category/{id}',[CategoryController::class,'Update'])->name('category.update');
Route::delete('/category/{id}',[CategoryController::class,"destroy"]);


//sub Category
// Route::resource('/subCategory',SubCategoryController::class);

Route::get('/subcategory',[SubCategoryController::class,'index'])->name('subcategory');
Route::get('/subcategory/{id}',[SubCategoryController::class,'show']);
Route::post('/subcategory',[SubCategoryController::class,'store'])->name('subcategory.store');
Route::delete('/subcategory/{id}',[SubCategoryController::class,'destroy'])->name('subcategory.destroy');
Route::put('/subcategory/{id}',[SubCategoryController::class,'update'])->name('subcategory.update');



// Brand 

Route::get('/brand',[BrandController::class,'index'])->name('brand');
Route::post('/brand',[BrandController::class,'store']);
Route::get('/brand/{id}',[BrandController::class,'show']);
Route::put('/brand/{id}',[BrandController::class, 'update'])->name('brand.update');
Route::delete('/brand/{id}',[BrandController::class,"destroy"])->name('brand.destroy');
Route::get('/brandSerch/{name}',[BrandController::class,'search']);

// Seller Information 
Route::get('/seller',[SellerController::class,'index'])->name('seller');
Route::post('/seller',[SellerController::class,'store'])->name('seller.store');
Route::get('/seller/{id}',[SellerController::class,'show']);
Route::put('/seller/{id}',[SellerController::class, 'update'])->name('seller.update');
Route::delete('/seller/{id}',[SellerController::class,"destroy"])->name('seller.destroy');
Route::get('/sellerSerch/{phone_number}',[SellerController::class,'search']);

// product 

Route::get('/product',[ProductController::class,"index"])->name('Product');
Route::post('/product',[ProductController::class,'store'])->name('product.store');
Route::get('/product/{id}',[ProductController::class,'show']);
Route::post('/productSearch',[ProductController::class,'search'])->name('shop.search');

//Add To Cart
Route::get('/shoppingCart',function (){
    return view('UserSite.userSiteComponent.shoppingCart');
});
Route::post('/addtocart',[CartCotroller::class,"addToCart"])->name('addToCart');
Route::get('/ShowCartpage',[CartCotroller::class,"ShowCartpage"])->name('ShowCartpage');
Route::put('/updateCart{id}',[CartCotroller::class,"updateCart"])->name('updateCart');
Route::delete('/deleteCart/{id}',[CartCotroller::class,'deleteCart'])->name('cart.delete');
Route::post('/cartIncrement/{id}', [CartCotroller::class,'increment'])->name('cart.increment');
Route::post('/cartDecrement/{id}', [CartCotroller::class,'decrement'])->name('cart.decrement');

// checkout 
Route::get('/checkout/{id}', [CheckoutController::class ,'index'])->name('checkout');
Route::post('/place-order', [CheckoutController::class,'placeOrder'])->name('placeOrder');


// Admin Order page 
Route::get('/order',[OrderderController::class,'index'])->name('order');



// user Profile 
Route::get('/userProfile',[UserProfileController::class,'index'])->name('userProfile');

Route::get('/orderConfirm',function(){
    return view('orderConfirm');
})->name('orderConfirm');
Route::post('/buynow',[CartCotroller::class,'buyNow'])->name('buynow');
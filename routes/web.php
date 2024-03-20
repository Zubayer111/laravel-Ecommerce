<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\PolicyController;
use App\Http\Middleware\TokenAuthenticate;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductCartController;
use App\Http\Controllers\ProductWisheController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\ProductSliderController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\HomeController;
use Symfony\Component\HttpKernel\Profiler\Profile;

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


// View Page
Route::get("/",[HomeController::class, "homePage"]);
Route::get("/by-category",[CategoryController::class, "categoryPage"]);
Route::get("/by-brand", [BrandController::class, "ByBrandPage"]);
Route::get("/policy", [PolicyController::class, "PolicyPage"]);
Route::get('/details', [ProductController::class, 'Details']);
Route::get('/login', [UserController::class, 'LoginPage']);
Route::get('/verify', [UserController::class, 'VerifyPage']);
Route::get('/wish', [ProductController::class, 'wishPage']);
Route::get('/cart', [ProductController::class, 'cartPage']);
Route::get('/profile', [CustomerProfileController::class, 'profilePage']);


// Brand List
Route::get("/brand-list",[BrandController::class, "brandList"]);

// Category List
Route::get("/category-list",[CategoryController::class, "categoryList"]);

//policy
Route::get("/policy/{type}",[PolicyController::class, "policyType"]);

// Product List
Route::get("/list-product-catagory/{id}",[ProductController::class, "listProductByCatagory"]);
Route::get("/list-product-remark/{remark}",[ProductController::class, "listProductByRemark"]);
Route::get("/list-product-brand/{id}",[ProductController::class, "listProductByBrand"]);

// Product Detail
Route::get("/product-detail/{id}",[ProductDetailController::class, "productDetailById"]);


// Product Slder List
Route::get("/list-product-slder",[ProductSliderController::class, "listProductSlder"]);

// Product Review List
Route::get("/review/list/{id}",[ProductReviewController::class, "listReviewProduct"]);
Route::post("/createProductReview",[ProductReviewController::class, "createProductReview"])->middleware([TokenAuthenticate::class]);

// User Auth
Route::get("/userLogin/{email}",[UserController::class, "userLogin"]);
Route::get("/VerifyLogin/{email}/{otp}", [UserController::class, "verifyLogin"]);
Route::get("/logout",[UserController::class,"userLogout"]);

// User Profile
Route::post("/createProfile", [CustomerProfileController::class, "CreateProfile"])->middleware([TokenAuthenticate::class]);
Route::get("/readProfile", [CustomerProfileController::class, "ReadProfile"])->middleware([TokenAuthenticate::class]);

// Product Wish
Route::get("/productWishList", [ProductWisheController::class, "productWishList"])->middleware([TokenAuthenticate::class]);
Route::get("/createWishList/{product_id}", [ProductWisheController::class, "createWishList"])->middleware([TokenAuthenticate::class]);
Route::get("/removeWishList/{product_id}", [ProductWisheController::class, "removeWishList"])->middleware([TokenAuthenticate::class]);

// Product Cart
Route::post("/createCartList", [ProductCartController::class, "createCartList"])->middleware([TokenAuthenticate::class]);
Route::get("/cartList", [ProductCartController::class, "cartList"])->middleware([TokenAuthenticate::class]);
Route::get("/deletCartList/{product_id}", [ProductCartController::class, "deletCartList"])->middleware([TokenAuthenticate::class]);

// Invoice and payment
Route::get("/invoiceCreate",[InvoiceController::class,"invoiceCreate"])->middleware([TokenAuthenticate::class]);
Route::get("/invoiceList",[InvoiceController::class,"invoiceList"])->middleware([TokenAuthenticate::class]);
Route::get("/invoiceDetail/{invoice_id}",[InvoiceController::class,"invoiceDetail"])->middleware([TokenAuthenticate::class]);

//payment
Route::post("/PaymentSuccess",[InvoiceController::class,"paymentSuccess"]);
Route::post("/PaymentCancel",[InvoiceController::class,"paymentCancel"]);
Route::post("/PaymentFail",[InvoiceController::class,"paymentFail"]);

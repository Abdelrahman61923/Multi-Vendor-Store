<?php

use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Front\CategoriesController;
use App\Http\Controllers\Front\PaymentsController;
use App\Http\Controllers\SocailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\CurrencyConverterController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Front\Auth\TwoFactorAuthentcationController;

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

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
], function() {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::controller(ProductController::class)->group(function () {
        Route::get('/products','index')->name('products.index');
        Route::get('/products/{product:slug}','show')->name('products.show');
    });

    Route::controller(CategoriesController::class)->group(function () {
        Route::get('/categories/{slug}','show')->name('categories.show');
    });

    Route::resource('cart', CartController::class);

    Route::controller(CheckoutController::class)->group(function () {
        Route::get('checkout','create')->name('checkout');
        Route::post('checkout','store');
    });

    Route::get('auth/user/2fa', [TwoFactorAuthentcationController::class, 'index'])
        ->name('front.2fa');

    Route::post('currency', [CurrencyConverterController::class, 'store'])
        ->name('currency.store');

    Route::controller(SocialLoginController::class)->group(function () {
        Route::get('auth/{provider}/redirect', 'redirect')->name('auth.socilaite.redirect');
        Route::get('auth/{provider}/callback', 'callback')->name('auth.socilaite.callback');
    });

    Route::controller(PaymentsController::class)->group(function () {
        Route::get('orders/{order}/pay','create')->name('orders.payments.create');
        Route::post('orders/{order}/stripe/payment-intent','createStripePaymentIntent')->name('stripe.paymentIntent.create');
        Route::get('orders/{order}/pay/stripe/callback','confirm')->name('stripe.return');
    });

});

require __DIR__.'/dashboard.php';

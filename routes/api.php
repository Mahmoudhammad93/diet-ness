<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CaloriesController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\GoalController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WalletController;
use App\Http\Controllers\Api\WishlistController;
use App\Library\MyFatoorah;
use App\Library\Payment;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'Lang'], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'store']);
        Route::post('vendor_register', [CompanyController::class, 'store']);
        Route::post('forget_password', [UserController::class, 'forget_password']);
        Route::post('forget_password_new_password', [UserController::class, 'forget_password_new']);
    });

    Route::get('guest/home', [HomeController::class, 'guest']);

    Route::get('settings', [SettingController::class, 'index']);
    Route::get('settings/about', [SettingController::class, 'about']);
    Route::get('settings/contacts', [SettingController::class, 'contact']);

    Route::group(['prefix' => 'addresses'], function () {
        Route::get('cities', [AddressController::class, 'cities']);
        Route::get('areas/{city_id}', [AddressController::class, 'areas']);
    });

    Route::group(['prefix' => 'packages'], function () {
        Route::get('', [PackageController::class, 'index']);
        Route::get('view/{id}', [PackageController::class, 'show']);
    });

    Route::post('search', [SearchController::class, 'index']);

    Route::group(['prefix' => 'payment'], function () {
        Route::get('callback/success', [Payment::class, 'callback_success']);
        Route::get('callback/faild', [Payment::class, 'callback_faild']);
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('terms', [SettingController::class, 'terms']);
        Route::get('privacy', [SettingController::class, 'privacy']);
    });

    /////////////////////////////////////// Auth /////////////////////////////////
    Route::group(['middleware' => 'auth:sanctum'], function () {

        Route::get('home', [HomeController::class, 'index']);

        Route::group(['prefix' => 'auth'], function () {
            Route::get('logout', [AuthController::class, 'logout']);
            Route::post('refresh_token', [AuthController::class, 'refresh_token']);
        });

        Route::group(['prefix' => 'users'], function () {
            Route::get('profile', [UserController::class, 'profile']);
            Route::post('update', [UserController::class, 'update']);
            Route::post('update_password', [UserController::class, 'update_password']);
        });

        Route::group(['prefix' => 'addresses'], function () {
            Route::get('', [AddressController::class, 'index']);
            Route::get('global', [AddressController::class, 'global']);
            Route::post('create', [AddressController::class, 'store']);
            Route::post('update', [AddressController::class, 'update']);
            Route::post('delete', [AddressController::class, 'destroy']);
        });

        Route::group(['prefix' => 'wishlists'], function () {
            Route::get('package/{id}', [WishlistController::class, 'package']);
        });

        Route::group(['prefix' => 'reviews'], function () {
            Route::post('package', [ReviewController::class, 'store_packages']);
        });

        Route::group(['prefix' => 'subscriptions'], function () {
            Route::post('create', [SubscriptionController::class, 'store']);
            Route::post('renew', [SubscriptionController::class, 'renew']);
            Route::post('change', [SubscriptionController::class, 'change']);
        });

        Route::group(['prefix' => 'wallets'], function () {
            Route::get('', [WalletController::class, 'index']);
        });

        Route::group(['prefix' => 'calories'], function () {
            Route::get('', [CaloriesController::class, 'index']);
            Route::post('update', [CaloriesController::class, 'update']);
        });

        Route::group(['prefix' => 'goals'], function () {
            Route::get('', [GoalController::class, 'index']);
            Route::post('create', [GoalController::class, 'store']);
        });

        Route::group(['prefix' => 'menu'], function () {
            Route::get('', [HomeController::class, 'getMenu']);
        });

    });

    Route::post('contact-us', [ContactUsController::class, 'contactUs']);
});

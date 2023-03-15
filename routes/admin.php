<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CaloriesController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GoalsController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SlidersController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\UserController;
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

Route::group(['middleware' => 'Lang'], function () {

    Route::group(['prefix' => 'admin'], function () {

        Route::get('login', [AuthController::class, 'login']);
        Route::post('login', [AuthController::class, 'auth']);

        Route::group(['prefix' => 'settings'], function () {
            Route::get('language/{lang}', [SettingController::class, 'language']);
            Route::get('theme/{theme}', [SettingController::class, 'theme']);
            Route::get('about', [SettingController::class, 'about']);
            Route::post('update', [SettingController::class, 'update']);
        });

        #################### Auth ##########################
        Route::group(['middleware' => 'admin'], function () {

            Route::get('logout', [AuthController::class, 'logout']);

            Route::get('', [DashboardController::class, 'index']);
            Route::get('home', [DashboardController::class, 'index']);

            Route::group(['prefix' => 'roles'], function () {
                Route::get('', [RoleController::class, 'index']);
                Route::get('create', [RoleController::class, 'create']);
                Route::post('create', [RoleController::class, 'store']);
                Route::get('view/{id}', [RoleController::class, 'show']);
                Route::get('edit/{id}', [RoleController::class, 'edit']);
                Route::post('update/{id}', [RoleController::class, 'update']);
                Route::post('delete', [RoleController::class, 'destroy']);
            });

            Route::group(['prefix' => 'notifications'], function () {
                Route::get('', [NotificationController::class, 'index']);
                Route::get('orders', [NotificationController::class, 'index_orders']);
                Route::get('read/{type}', [NotificationController::class, 'read']);
                Route::get('notify', [NotificationController::class, 'notify']);
                Route::get('board_notify', [NotificationController::class, 'board_notify']);
            });

            Route::group(['prefix' => 'search'], function () {
                Route::get('', [SearchController::class, 'index']);
            });

            Route::group(['prefix' => 'settings'], function () {
                Route::get('', [SettingController::class, 'index']);
                Route::get('terms', [SettingController::class, 'terms']);
                Route::get('privacy', [SettingController::class, 'privacy']);
                Route::get('about', [SettingController::class, 'about']);
                Route::get('contacts', [SettingController::class, 'contacts']);
                Route::post('', [SettingController::class, 'update']);
            });

            Route::group(['prefix' => 'admins'], function () {
                Route::get('', [AdminController::class, 'index']);
                Route::get('create', [AdminController::class, 'create']);
                Route::get('edit/{id}', [AdminController::class, 'edit']);
                Route::get('view/{id}', [AdminController::class, 'show']);
                Route::get('logs/{id}', [AdminController::class, 'logs']);
                Route::get('logs', [AdminController::class, 'logs']);
                Route::get('reports', [AdminController::class, 'reports']);
                Route::get('reports/today/view/{id}', [AdminController::class, 'reports_today']);
                Route::get('reports/reports/view/{id}', [AdminController::class, 'reports_all']);
                Route::post('create', [AdminController::class, 'store']);
                Route::post('update/{id}', [AdminController::class, 'update']);
                Route::post('delete', [AdminController::class, 'destroy']);
                Route::get('deleted', [AdminController::class, 'deleted']);
                Route::get('restore/{id}', [AdminController::class, 'restore']);
                Route::get('force_delete', [AdminController::class, 'force_delete']);
            });

            Route::group(['prefix' => 'users'], function () {
                Route::get('', [UserController::class, 'index']);
                Route::get('create', [UserController::class, 'create']);
                Route::get('edit/{id}', [UserController::class, 'edit']);
                Route::get('view/{id}', [UserController::class, 'show']);
                Route::post('create', [UserController::class, 'store']);
                Route::post('update/{id}', [UserController::class, 'update']);
                Route::post('delete', [UserController::class, 'destroy']);
            });

            Route::group(['prefix' => 'cities'], function () {
                Route::get('', [CityController::class, 'index']);
                Route::get('create', [CityController::class, 'create']);
                Route::get('edit/{id}', [CityController::class, 'edit']);
                Route::get('view/{id}', [CityController::class, 'show']);
                Route::post('create', [CityController::class, 'store']);
                Route::post('update/{id}', [CityController::class, 'update']);
                Route::post('delete', [CityController::class, 'destroy']);
            });

            Route::group(['prefix' => 'areas'], function () {
                Route::post('city', [AreaController::class, 'city']);
                Route::post('delivery/create', [AreaController::class, 'delivery_create']);
                Route::post('create', [AreaController::class, 'store']);
                Route::post('update', [AreaController::class, 'update']);
                Route::post('delete', [AreaController::class, 'destroy']);
            });

            Route::group(['prefix' => 'packages'], function () {
                Route::get('', [PackageController::class, 'index']);
                Route::get('create', [PackageController::class, 'create']);
                Route::get('view/{id}', [PackageController::class, 'show']);
                Route::get('edit/{id}', [PackageController::class, 'edit']);
                Route::post('create', [PackageController::class, 'store']);
                Route::post('update/{id}', [PackageController::class, 'update']);
                Route::post('delete', [PackageController::class, 'destroy']);

                Route::group(['prefix' => 'plans'], function () {
                    Route::get('{id}', [PlanController::class, 'index']);
                    Route::get('create/{id}', [PlanController::class, 'create']);
                    Route::get('edit/{id}', [PlanController::class, 'edit']);
                    Route::post('create/{id}', [PlanController::class, 'store']);
                    Route::post('update/{id}', [PlanController::class, 'update']);
                    Route::post('delete', [PlanController::class, 'destroy']);
                });
            });

            Route::group(['prefix' => 'calories'], function(){
                Route::get('', [CaloriesController::class, 'index']);
            });

            Route::group(['prefix' => 'goals'], function(){
                Route::get('', [GoalsController::class, 'index']);
            });

            Route::group(['prefix' => 'sliders'], function(){
                Route::get('', [SlidersController::class, 'index']);
                Route::get('create', [SlidersController::class, 'create']);
                Route::post('store', [SlidersController::class, 'store']);
                Route::get('edit/{slider}', [SlidersController::class, 'edit']);
                Route::post('update/{slider}', [SlidersController::class, 'update']);
                Route::post('delete/{id}', [SlidersController::class, 'destroy']);
            });

            Route::group(['prefix' => 'subscriptions'], function () {
                Route::get('', [SubscriptionController::class, 'index']);
                Route::get('ended', [SubscriptionController::class, 'ended']);
                Route::get('started', [SubscriptionController::class, 'started']);
                Route::get('view/{id}', [SubscriptionController::class, 'show']);
            });

            Route::group(['prefix' => 'sales'], function () {
                Route::get('', [SaleController::class, 'index']);
                Route::get('daily', [SaleController::class, 'today']);
                Route::get('weekly', [SaleController::class, 'week']);
                Route::get('monthly', [SaleController::class, 'month']);
                Route::get('yearly', [SaleController::class, 'year']);
                Route::get('view/{id}', [SaleController::class, 'show']);
            });
        });
    });
});

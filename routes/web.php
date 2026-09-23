<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\GoldRateController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\DashboardController;



// Public pages
Route::view('/', 'pages.home');
Route::get('/shop', [ProductController::class, 'shopIndex']);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::get('/collections', [ProductController::class, 'collectionsIndex']);
Route::get('/gold-saving-scheme', [PlanController::class, 'userIndex']);


Route::get('/offers', [OfferController::class, 'userIndex']);

Route::get('/gold-rate', [GoldRateController::class, 'userIndex']);

Route::view('/book-appointment', 'pages.book-appointment');
Route::post('/book-appointment', [AppointmentController::class, 'store']);

Route::view('/store-locator', 'pages.store-locator');
Route::view('/about', 'pages.about');
Route::view('/contact', 'pages.contact');


// Auth
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout']);


// Customer dashboard (must be logged in)
Route::middleware('auth')->group(function () {

    Route::view('/dashboard', 'dashboard.index');
    Route::post('/dashboard/my-plans/{id}/close', [DashboardController::class, 'closePlan']);
    Route::get('/dashboard/my-plans', [DashboardController::class, 'myPlans']);
    Route::get('/dashboard/my-plans/{id}', [DashboardController::class, 'planDetails']);
    Route::get('/dashboard/new-plan', [DashboardController::class, 'newPlan']);
    Route::post('/dashboard/new-plan', [DashboardController::class, 'enroll']);

    Route::post('/dashboard/my-plans/{id}/pay', [DashboardController::class, 'payEmi']);
    Route::get('/dashboard/payment-history', [DashboardController::class, 'paymentHistory']);
    Route::view('/dashboard/gold-weight', 'dashboard.gold-weight');
    Route::get('/dashboard/closed-plans', [DashboardController::class, 'closedPlans']);
    Route::view('/dashboard/notifications', 'dashboard.notifications');
    Route::view('/dashboard/profile', 'dashboard.profile');

});


// Admin dashboard (must be admin)
Route::middleware('admin')->group(function () {

    Route::view('/admin', 'admin.index');
    Route::view('/admin/customers', 'admin.customers');
    Route::get('/admin/plans', [PlanController::class, 'adminIndex']);
    Route::post('/admin/plans', [PlanController::class, 'store']);
    Route::get('/admin/plans/{id}/delete', [PlanController::class, 'destroy']);

    Route::view('/admin/payments', 'admin.payments');
    Route::get('/admin/products', [ProductController::class, 'adminIndex']);
    Route::post('/admin/products', [ProductController::class, 'store']);
    Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit']);
    Route::put('/admin/products/{id}', [ProductController::class, 'update']);
    Route::get('/admin/products/{id}/delete', [ProductController::class, 'destroy']);



    // Offers
    Route::get('/admin/offers', [OfferController::class, 'adminIndex']);

    Route::post('/admin/offers', [OfferController::class, 'store']);

    Route::get('/admin/offers/{id}/edit', [OfferController::class, 'edit']);

    Route::put('/admin/offers/{id}', [OfferController::class, 'update']);

    Route::get('/admin/offers/{id}/delete', [OfferController::class, 'destroy']);


    // Appointments
    Route::get('/admin/appointments', [AppointmentController::class, 'adminIndex']);


    // Gold Rate
    Route::get('/admin/gold-rate', [GoldRateController::class, 'adminIndex']);
    Route::post('/admin/gold-rate', [GoldRateController::class, 'store']);


    Route::view('/admin/reports', 'admin.reports');
    Route::view('/admin/settings', 'admin.settings');

});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\GoldRateController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;



// Public pages
Route::get('/', [HomeController::class, 'index']);
Route::get('/shop', [ProductController::class, 'shopIndex']);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::get('/collections', [ProductController::class, 'collectionsIndex']);
Route::get('/gold-saving-scheme', [PlanController::class, 'userIndex']);


Route::get('/offers', [OfferController::class, 'userIndex']);

Route::get('/gold-rate', [GoldRateController::class, 'userIndex']);

Route::get('/book-appointment', [AppointmentController::class, 'create']);
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

    Route::get('/dashboard/wishlist', [App\Http\Controllers\WishlistController::class, 'index']);
    Route::post('/wishlist/toggle', [App\Http\Controllers\WishlistController::class, 'toggle']);


    Route::get('/dashboard', [DashboardController::class, 'index']);
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
    Route::post('/dashboard/profile', [DashboardController::class, 'updateProfile']);
    
    Route::get('/dashboard/appointments', [DashboardController::class, 'appointments']);
    Route::post('/dashboard/appointments/{id}/cancel', [DashboardController::class, 'cancelAppointment']);
});


// Admin dashboard (must be admin)
Route::middleware('admin')->group(function () {

    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/search', [\App\Http\Controllers\AdminSearchController::class, 'search'])->name('admin.search');

    // Customers
    Route::get('/admin/customers', [AdminController::class, 'customers']);
    Route::post('/admin/customers/{id}/delete', [AdminController::class, 'destroyCustomer']);

    // Plans
    Route::get('/admin/plans', [PlanController::class, 'adminIndex']);
    Route::post('/admin/plans', [PlanController::class, 'store']);
    Route::get('/admin/plans/{id}/edit', [PlanController::class, 'edit']);
    Route::put('/admin/plans/{id}', [PlanController::class, 'update']);
    Route::post('/admin/plans/{id}/delete', [PlanController::class, 'destroy']);

    // Payments
    Route::get('/admin/payments', [AdminController::class, 'payments']);

    // Products
    Route::get('/admin/products', [ProductController::class, 'adminIndex']);
    Route::post('/admin/products', [ProductController::class, 'store']);
    Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit']);
    Route::put('/admin/products/{id}', [ProductController::class, 'update']);
    Route::post('/admin/products/{id}/delete', [ProductController::class, 'destroy']);

    // Collections
    Route::get('/admin/collections', [CollectionController::class, 'adminIndex']);
    Route::post('/admin/collections', [CollectionController::class, 'store']);
    Route::get('/admin/collections/{id}/edit', [CollectionController::class, 'edit']);
    Route::put('/admin/collections/{id}', [CollectionController::class, 'update']);
    Route::post('/admin/collections/{id}/delete', [CollectionController::class, 'destroy']);

    // Offers
    Route::get('/admin/offers', [OfferController::class, 'adminIndex']);
    Route::post('/admin/offers', [OfferController::class, 'store']);
    Route::get('/admin/offers/{id}/edit', [OfferController::class, 'edit']);
    Route::put('/admin/offers/{id}', [OfferController::class, 'update']);
    Route::post('/admin/offers/{id}/delete', [OfferController::class, 'destroy']);

    // Appointments
    Route::get('/admin/appointments', [AppointmentController::class, 'adminIndex']);
    Route::post('/admin/appointments/{id}/delete', [AppointmentController::class, 'destroy']);

    // Gold Rate
    Route::get('/admin/gold-rate', [GoldRateController::class, 'adminIndex']);
    Route::post('/admin/gold-rate', [GoldRateController::class, 'store']);
    Route::post('/admin/gold-rate/{id}/delete', [GoldRateController::class, 'destroy']);

    Route::get('/admin/reports', [AdminController::class, 'reports']);
    Route::get('/admin/settings', [AdminController::class, 'settings']);
    Route::post('/admin/settings', [AdminController::class, 'updateSettings']);

});
<?php

use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\Web\HomePageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/package-name/{id}', [HomePageController::class, 'show'])->name('show');
Route::get('/formData/{id}', [HomePageController::class, 'formData'])->middleware(['auth', 'checkrole:user'])->name('formData');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home-cms');

// role admin
Route::prefix('admin')->middleware(['auth', 'checkrole:admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard.index');
    
    // Catalogue
    Route::resource('/catalogue', CatalogueController::class)->names('admin.catalogue');
    
    // Order Admin
    Route::resource('/order', AdminOrderController::class)->names('admin.order');

    Route::get('/report', [ReportController::class, 'index'])->name('admin.report.index');
});

// role user
Route::prefix('user')->middleware(['auth', 'checkrole:user'])->group(function () {

    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard.index');

    // Order
    Route::resource('/order', OrderController::class)->names('user.order');

    // Profile
    Route::get('/profile/edit', [App\Http\Controllers\User\ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::put('/profile/update', [App\Http\Controllers\User\ProfileController::class, 'update'])->name('user.profile.update');
});



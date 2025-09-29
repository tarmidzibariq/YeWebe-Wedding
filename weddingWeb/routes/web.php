<?php

use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Web\HomePageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/package-name/{id}', [HomePageController::class, 'show'])->name('show');


Route::prefix('admin')->middleware(['auth', 'checkrole:admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard.index');

    // Catalogue
    Route::resource('/catalogue', CatalogueController::class)->names('admin.catalogue');
});



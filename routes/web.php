<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TravelPackageController;
use App\Http\Controllers\TravelPackageTypeController;
use App\Models\TravelPackage;
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

Route::get('/', function () {
    return view('welcome', [
        'travel_packages' => TravelPackage::where('featured', true)->get()
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    //Admin
    Route::get('/profile/{user}', [ProfileController::class, 'profile'])->name('profile.display');
    Route::delete('/profile/{user}', [ProfileController::class, 'deleteUser'])->name('delete.user');
    Route::get('/users', [ProfileController::class, 'users'])->name('users');

    //User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/notifications', [ProfileController::class, 'notifications'])->name('notifications');
    Route::post('/notifications/read', [ProfileController::class, 'readNotifications'])->name('read.notifications');
    Route::delete('/notifications/delete', [ProfileController::class, 'deleteNotifications'])->name('delete.notifications');

    //Agency 
    Route::patch('/agency', [AgencyController::class, 'update'])->name('agency.update');
    
    //Travel Packages 
    Route::get('/packages', [TravelPackageController::class, 'index'])->name('package.index');
    Route::get('/packages/all', [TravelPackageController::class, 'all'])->name('package.all');
    Route::get('/packages/create', [TravelPackageController::class, 'create'])->name('package.create');
    Route::post('/packages', [TravelPackageController::class, 'store'])->name('package.store');
    Route::get('/packages/{package}', [TravelPackageController::class, 'display'])->name('package.display');
    Route::get('/packages/edit/{package}', [TravelPackageController::class, 'edit'])->name('package.edit');
    Route::patch('/packages/{package}', [TravelPackageController::class, 'update'])->name('package.update');
    Route::delete('/packages/{package}', [TravelPackageController::class, 'delete'])->name('package.delete');
    Route::patch('/packages/check/{package}', [TravelPackageController::class, 'status'])->name('package.status');

    //Location 
    Route::post('/locations/store/{package}', [LocationController::class, 'store'])->name('location.store');
    Route::delete('/locations/{location}', [LocationController::class, 'destroy'])->name('location.destroy');
    Route::patch('/locations/{location}', [LocationController::class, 'update'])->name('location.update');

    //Travel Package Types
    Route::post('/packageTypes/store/{package}', [TravelPackageTypeController::class, 'store'])->name('packageType.store');
    Route::delete('/packageTypes/{packageType}', [TravelPackageTypeController::class, 'destroy'])->name('packageType.destroy');
    Route::patch('/packageTypes/{packageType}', [TravelPackageTypeController::class, 'update'])->name('packageType.update');
});

require __DIR__.'/auth.php';

Route::middleware('guest')->group(function () {
    Route::get('/agency', [AgencyController::class, 'create'])->name('agency.create');
    Route::post('/agency', [AgencyController::class, 'store'])->name('agency.store');
});

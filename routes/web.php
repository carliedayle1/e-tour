<?php

use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\TravelPackage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\AttractionController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SubscriptionsController;
use App\Http\Controllers\TravelPackageController;
use App\Http\Controllers\TravelPackageTypeController;
use App\Models\Attraction;

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
        'travel_packages' => TravelPackage::where('status', 'active')->latest()->filter(request(['search']))->paginate(6),
        'locations' => Location::all()->pluck('image'),
        'attractions' => Attraction::latest()->filter(request(['search']))->paginate(6)
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'travel_packages' => TravelPackage::where('status', 'active')->latest()->filter(request(['search']))->paginate(6),
        'attractions' => Attraction::latest()->filter(request(['search']))->paginate(6)
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    //Admin
    Route::get('/profile/{user}', [ProfileController::class, 'profile'])->name('profile.display');
    Route::delete('/profile/{user}', [ProfileController::class, 'deleteUser'])->name('delete.user');
    Route::get('/users', [ProfileController::class, 'users'])->name('users');

    // Route::get('/billing-portal', function (Request $request) {
    //     $request->user()->createOrGetStripeCustomer();
    //     return $request->user()->redirectToBillingPortal(route('dashboard'));
    // });

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
    Route::get('/travel-packages/view/{package}', [TravelPackageController::class, 'authTravelerView'])->name('package.authTravelerView');
    Route::post('/packages/book', [TravelPackageController::class, 'bookPackage'])->name('package.book');
    Route::get('/travel-plan', [TravelPackageController::class, 'travelPlan'])->name('travel.plan');
    Route::get('/travel-packages/compare', [TravelPackageController::class, 'compare'])->name('package.compare');


    //Bookings
    Route::post('/booking/cancel/{booking}', [TravelPackageController::class, 'cancelBooking'])->name('cancel.booking');
    Route::get('/bookings', [TravelPackageController::class, 'bookings'])->name('bookings');
    Route::post('/bookings/confirm/{booking}', [BookingController::class, 'confirmBooking'])->name('confirm.booking');

    //Feedbacks
    Route::post('/bookings/feedback', [BookingController::class, 'storeFeedback'])->name('store.feedback');

    //Location 
    Route::post('/locations/store/{package}', [LocationController::class, 'store'])->name('location.store');
    Route::delete('/locations/{location}', [LocationController::class, 'destroy'])->name('location.destroy');
    Route::patch('/locations/{location}', [LocationController::class, 'update'])->name('location.update');

    //Travel Package Types
    Route::post('/packageTypes/store/{package}', [TravelPackageTypeController::class, 'store'])->name('packageType.store');
    Route::delete('/packageTypes/{packageType}', [TravelPackageTypeController::class, 'destroy'])->name('packageType.destroy');
    Route::patch('/packageTypes/{packageType}', [TravelPackageTypeController::class, 'update'])->name('packageType.update');

    //Subscription Plans
    Route::get('/subscription-plans', [SubscriptionsController::class, 'index'])->name('subscription.plans');
    Route::post('/single-charge', [SubscriptionsController::class, 'singleCharge'])->name('single.charge');
    Route::get('/subscription-plans/create', [SubscriptionsController::class, 'create'])->name('subscription.create');
    Route::post('/subscription-plans/store', [SubscriptionsController::class, 'store'])->name('plan.store');
    Route::get('/subscriptions', [SubscriptionsController::class, 'display'])->name('subscriptions');
    Route::get('/subscriptions/{name}', [SubscriptionsController::class, 'subscribe'])->name('subscribe');
    Route::post('/subscriptions/process', [SubscriptionsController::class, 'process'])->name('subscription.process');
    Route::get('/subscription/details', [SubscriptionsController::class, 'details'])->name('subscription.details');
    Route::post('/subscription/cancel/{name}', [SubscriptionsController::class, 'cancel'])->name('subscription.cancel');
    Route::post('/subscription/resume/{name}', [SubscriptionsController::class, 'resume'])->name('subscription.resume');

    // Attractions
    Route::get('/admin/attractions', [AttractionController::class, 'index'])->name('admin.attractions');
    Route::get('/admin/attractions/create', [AttractionController::class, 'create'])->name('create.attractions');
    Route::post('/attractions/store', [AttractionController::class, 'store'])->name('attractions.store');
    Route::get('/attractions/{attraction}', [AttractionController::class, 'show'])->name('attraction.show');
    Route::get('/attractions/edit/{attraction}', [AttractionController::class, 'edit'])->name('attraction.edit');
    Route::patch('/attractions/update/{attraction}', [AttractionController::class, 'update'])->name('attraction.update');
    Route::delete('/attractions/{attraction}', [AttractionController::class, 'delete'])->name('attraction.delete');

    //Itinerary
    Route::get('/itineraries', [ItineraryController::class, 'index'])->name('itineraries');
    Route::post('/itineraries', [ItineraryController::class, 'store'])->name('itinerary.store');
    Route::get('/itineraries/edit/{itinerary}',[ItineraryController::class, 'edit'])->name('itinerary.edit');
    Route::get('/itineraries/customize/{itineraryDate}', [ItineraryController::class, 'customize'])->name('itineraries.customize');
    Route::post('/itineraries/items/store', [ItineraryController::class, 'storeItems'])->name('itinerary.store.items');
    Route::patch('/itineraries/update/{itinerary}', [ItineraryController::class, 'update'])->name('itinerary.update');
    Route::delete('/itineraries/date/delete/{date}', [ItineraryController::class, 'deleteDate'])->name('itinerary.delete.date');
    Route::delete('/itineraries/{itinerary}', [ItineraryController::class, 'delete'])->name('itinerary.delete');

    //Calendar
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');

    //Reports
    Route::get('/reports/itineraries/{itinerary}', [ReportsController::class, 'itinerary'])->name('reports.itinerary');
    Route::get('/reports/bookings/{booking}', [ReportsController::class, 'booking'])->name('reports.booking');



});

require __DIR__.'/auth.php';

Route::middleware('guest')->group(function () {
    Route::get('/agency', [AgencyController::class, 'create'])->name('agency.create');
    Route::post('/agency', [AgencyController::class, 'store'])->name('agency.store');

    //Traveler Routes
    Route::get('/travel-packages/{package}', [TravelPackageController::class, 'travelerView'])->name('package.travelerView');
    Route::get('/travel-packages/compare/view', [TravelPackageController::class, 'compareView'])->name('package.compareView');
    
});

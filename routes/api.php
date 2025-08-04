<?php


use App\Http\Controllers\API\Auth\AuthenticatedController;
use App\Http\Controllers\API\Auth\NewPasswordController;
use App\Http\Controllers\API\Auth\RegisteredController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\CMS\BookingPageController;
use App\Http\Controllers\API\CMS\CMSMenuController;
use App\Http\Controllers\API\CMS\CompanyProfileController;
use App\Http\Controllers\API\CMS\GalleryController;
use App\Http\Controllers\API\CMS\HomePageController;
use App\Http\Controllers\API\CMS\ProductCategoryController;
use App\Http\Controllers\API\CMS\VenueRoomController;
use App\Http\Controllers\API\CMS\VideoController;
use App\Http\Controllers\API\Data\ContactUsController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\Master\MasterAreaController;
use App\Http\Controllers\API\Master\MasterBuildingController;
use App\Http\Controllers\API\Master\MasterProductController;
use App\Http\Controllers\API\Master\MasterPackageController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\VenueController;
use App\Http\Controllers\Email\GmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Recaptcha\RecaptchaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/verify', [RecaptchaController::class, 'verify'])->name('api.recaptcha.verify');
Route::post('/login', [AuthenticatedController::class, 'store'])->name('api.login');
Route::post('/register', [RegisteredController::class, 'store'])->name('api.register');
Route::post('/forgot-password', [NewPasswordController::class, 'store'])->name('api.forgot-password');

Route::get('/master-building', [MasterBuildingController::class, 'getMasterBuilding'])->name('api.master-building');
Route::get('/get-product-building/{building_id}', [MasterProductController::class, 'productByBuilding'])->name('api.product-by-building');
Route::get('/get-package-detail/{product_id}', [MasterPackageController::class, 'detailPackageByProduct'])->name('api.detail-package-by-product');

Route::post('/data/save-contact-us', [ContactUsController::class, 'saveContactUs'])->name('api.data.save-contact-us');
Route::post('/refresh-token', [AuthenticatedController::class, 'refreshToken'])->name('api.oauth.refresh-token');

Route::get('/events', [EventController::class, 'eventsByStatus']);
Route::get('/events/search', [EventController::class, 'eventsBySearch']);

Route::get('/product-categories', [ProductCategoryController::class, 'index'])->name('api.product-categories');
Route::get('/products', [ProductController::class, 'index']);
Route::post('/products/{product_id}/cart', [CartController::class, 'store']);

Route::get('/venues', [VenueController::class, 'index']);
Route::get('/galleries', [GalleryController::class, 'index']);
Route::get('/videos', [VideoController::class, 'index']);

Route::post('/contact-us', [GmailController::class, 'submit'])->name('api.contact-us');

Route::get('/users/{user_id}/carts', [CartController::class, 'index'])->whereUuid('user_id');
Route::post('/carts/{id}/increment', [CartController::class, 'increment']);
Route::post('/carts/{id}/decrement', [CartController::class, 'decrement']);
Route::delete('/carts/{id}', [CartController::class, 'destroy']);

// CMS PAGE
Route::get('/cms-menu', [CMSMenuController::class, 'index'])->name('api.cms-menu');
Route::get('/homepage', [HomePageController::class, 'index'])->name('api.homepage');
Route::get('/bookingpage', [BookingPageController::class, 'index'])->name('api.bookingpage');
Route::get('/company-profile', [CompanyProfileController::class, 'index'])->name('api.company-profile');
Route::get('/venue-rooms', [VenueRoomController::class, 'index'])->name('api.venue-rooms');
Route::get('/company-phone-number', [CompanyProfileController::class, 'companyPhoneNumber'])->name('api.company-phone-number');


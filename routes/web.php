<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShelterController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegisterController;

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
Route::get('/', [HomeController::class, 'index'])->name('home');


Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/profile', [ProfileController::class, 'index']);
Route::get('/data/donations', [ProfileController::class, 'datadonate']);
Route::get('/data/adoptions', [ProfileController::class, 'dataadoption']);
Route::get('/data/shelters', [ProfileController::class, 'datashelter']);
Route::get('/data/adoption/{id}', [ProfileController::class, 'adoptionsingle']);
Route::get('/data/shelter/{id}', [ProfileController::class, 'sheltersingle']);
Route::put('update-profile', [ProfileController::class, 'update'])->name('update.profile');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/donates', [DonateController::class, 'index']);
Route::post('/donates/create', [DonateController::class, 'store'])->middleware('auth');

Route::post('/adoptions/create', [AdoptionController::class, 'store'])->middleware('auth');
// Route::post('/adoptions/update/{id}', [AdoptionController::class, 'update'])->middleware('auth');

Route::get('/shelters', [ShelterController::class, 'index']);
Route::post('/shelters/create', [ShelterController::class, 'store'])->middleware('auth');
// Route::post('/shelters/update/{id}', [ShelterController::class, 'update'])->middleware('auth');


Route::patch('change-password', [PasswordController::class, 'update'])->name('change.password');




//midtrans
Route::get('/transaction/{id}/{type}', [DonateController::class, 'transaction']);

//notif
Route::patch('notification/{notification}/read', [NotificationController::class,'read'])->name('notification.read');



Route::get('/dashboard', [DonateController::class, 'data'])->middleware('auth:admin'); 
    
Route::get('/dashboard/donates', [DonateController::class, 'datadonate'])->middleware('auth:admin')->name('donates.index');
Route::get('/dashboard/donate/{type}/{id}', [DonateController::class, 'show'])->middleware('auth:admin');
Route::delete('/donate/shelter/{id}', [DonateController::class, 'destroyShelter'])->name('shelter.destroy');
Route::delete('/donate/adoption/{id}', [DonateController::class, 'destroyAdoption'])->name('adoption.destroy');
Route::delete('/donate/campaign/{id}', [DonateController::class, 'destroyCampaign'])->name('campaign.destroy');
Route::get('/donates/search', [DonateController::class, 'search']);

Route::get('/dashboard/adoptions', [AdoptionController::class, 'dataadoption'])->middleware('auth:admin');
Route::get('/dashboard/adoption/{id}', [AdoptionController::class, 'show'])->middleware('auth:admin');
Route::delete('/dashboard/adoptions/{id}', [AdoptionController::class, 'destroy']);
Route::get('/adoptions/search', [AdoptionController::class, 'search']);

Route::get('/dashboard/shelters', [ShelterController::class, 'datashelter'])->middleware('auth:admin');
Route::get('/dashboard/shelter/{id}', [ShelterController::class, 'show'])->middleware('auth:admin');
Route::delete('/dashboard/shelters/{id}', [ShelterController::class, 'destroy']);
Route::get('/shelters/search', [ShelterController::class, 'search']);

Route::get('/dashboard/pets/checkSlug', [PetController::class, 'checkSlug' ])->middleware('auth:admin');
Route::resource('/dashboard/pets', PetController::class)->middleware('auth:admin');
Route::get('/pets/search', [PetController::class, 'search']);

Route::get('/dashboard/campaigns/checkSlug', [CampaignController::class, 'checkSlug'])->middleware('auth:admin');
Route::resource('/dashboard/campaigns', CampaignController::class)->middleware('auth:admin');
Route::get('/campaigns/search', [CampaignController::class, 'search']);

Route::get('/dashboard/categories/checkSlug', [CategoryController::class, 'checkSlug'])->middleware('auth:admin');
Route::resource('/dashboard/categories', CategoryController::class)->middleware('auth:admin');
Route::get('/categories/search', [CategoryController::class, 'search']);

Route::get('/pets', [PetController::class, 'petall']);
Route::get('/pet/{pet:slug}', [PetController::class, "pet"]);

Route::get('/campaigns', [CampaignController::class, 'campaignall']);
Route::get('/campaign/{campaign:slug}', [CampaignController::class, "campaign"]);



Route::patch('/shelters/approve/{id}', [ShelterController::class, 'approve'])->name('shelters.approve');
Route::patch('/shelters/decline/{id}',  [ShelterController::class, 'decline'])->name('shelters.decline');

Route::patch('/adoptions/approve/{id}', [AdoptionController::class, 'approve'])->name('adoptions.approve');
Route::patch('/adoptions/decline/{id}',  [AdoptionController::class, 'decline'])->name('adoptions.decline');




// google
Route::get('/google', [LoginController::class,'redirectToProvider']);
Route::get('/callback', [LoginController::class,'handleProviderCallback']);

// facebook
Route::get('/facebook', [LoginController::class,'redirectToFacebook']);
Route::get('/callback', [LoginController::class,'handleFacebookCallback']);
<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShelterController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CategoryController;
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
Route::get('/', function () {
    return view('home');
});


Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/profile', [ProfileController::class, 'index']);
Route::get('/data/donation', [ProfileController::class, 'datadonate']);
Route::get('/data/adoption', [ProfileController::class, 'dataadoption']);
Route::get('/data/shelter', [ProfileController::class, 'datashelter']);
Route::resource('/profile', ProfileController::class);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/donates', [DonateController::class, 'index']);
Route::post('/donates/create', [DonateController::class, 'store'])->middleware('auth');

Route::post('/adoptions/create/{id}', [AdoptionController::class, 'store'])->middleware('auth');
Route::post('/adoptions/update/{id}', [AdoptionController::class, 'update'])->middleware('auth');

Route::get('/shelters', [ShelterController::class, 'index']);
Route::post('/shelters/create', [ShelterController::class, 'store'])->middleware('auth');
Route::post('/shelters/update/{id}', [ShelterController::class, 'update'])->middleware('auth');


Route::post('change-password', [PasswordController::class, 'update'])->name('change.password');




//midtrans
Route::get('/transaction/{id}', [DonateController::class, 'transaction']);





Route::get('/dashboard', [DonateController::class, 'data'])->middleware('auth:admin'); 
    
Route::get('/dashboard/donates', [DonateController::class, 'datadonate'])->middleware('auth:admin')->name('donates.index');
Route::get('/dashboard/donate/{id}', [DonateController::class, 'show'])->middleware('auth:admin');
Route::delete('/dashboard/donates/{id}', [DonateController::class, 'destroy'])->middleware('auth:admin');

Route::get('/dashboard/adoptions', [AdoptionController::class, 'dataadoption'])->middleware('auth:admin');
Route::get('/dashboard/adoption/{id}', [AdoptionController::class, 'show'])->middleware('auth:admin');
// Route::delete('/dashboard/adoptions/{id}', [AdoptionController::class, 'destroy'])->middleware('auth:admin');

Route::get('/dashboard/shelters', [ShelterController::class, 'datashelter'])->middleware('auth:admin');
Route::get('/dashboard/shelter/{id}', [ShelterController::class, 'show'])->middleware('auth:admin');
// Route::delete('/dashboard/shelters/{id}', [ShelterController::class, 'destroy'])->middleware('auth:admin');

Route::get('/dashboard/pets/checkSlug', [PetController::class, 'checkSlug' ])->middleware('auth:admin');
Route::resource('/dashboard/pets', PetController::class)->middleware('auth:admin');

Route::get('/dashboard/campaigns/checkSlug', [CampaignController::class, 'checkSlug'])->middleware('auth:admin');
Route::resource('/dashboard/campaigns', CampaignController::class)->middleware('auth:admin');

Route::get('/dashboard/categories/checkSlug', [CategoryController::class, 'checkSlug'])->middleware('auth:admin');
Route::resource('/dashboard/categories', CategoryController::class)->middleware('auth:admin');

Route::get('/pets', [PetController::class, 'petall']);
Route::get('/pet/{pet:slug}', [PetController::class, "pet"]);

Route::get('/campaigns', [CampaignController::class, 'campaignall']);
Route::get('/campaign/{campaign:slug}', [CampaignController::class, "campaign"]);



Route::get('/shelters/approve/{id}', [ShelterController::class, 'approve'])->name('shelters.approve');
Route::get('/shelters/decline/{id}',  [ShelterController::class, 'decline'])->name('shelters.decline');

Route::get('/adoptions/approve/{id}', [AdoptionController::class, 'approve'])->name('adoptions.approve');
Route::get('/adoptions/decline/{id}',  [AdoptionController::class, 'decline'])->name('adoptions.decline');



Route::get('/donations/campaign/{id}', [DonateController::class, 'byCampaignId']);
Route::get('/donations/adoption/{id}', [DonateController::class, 'byAdoptionId']);
Route::get('/donations/shelter/{id}', [DonateController::class, 'byShelterId']);



// google
Route::get('/google', [LoginController::class,'redirectToProvider']);
Route::get('/callback', [LoginController::class,'handleProviderCallback']);

// facebook
Route::get('/facebook', [LoginController::class,'redirectToFacebook']);
Route::get('/callback', [LoginController::class,'handleFacebookCallback']);
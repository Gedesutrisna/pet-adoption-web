<?php

use App\Http\Controllers\AdoptionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShelterController;

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
Route::post('/profile/update', [ProfileController::class, 'update']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/donates', [DonateController::class, 'index']);
Route::post('/donates/create', [DonateController::class, 'store'])->middleware('auth');

Route::post('/adoptions/create/{id}', [AdoptionController::class, 'store'])->middleware('auth');

Route::get('/shelters', [ShelterController::class, 'index']);
Route::post('/shelters/create', [ShelterController::class, 'store'])->middleware('auth');


Route::post('change-password', [PasswordController::class, 'update'])->name('change.password');










Route::get('/dashboard', function(){
    return view('admin.index');
})->middleware('auth:admin');
    
    
Route::get('/dashboard/donates', [DonateController::class, 'datadonate'])->middleware('auth:admin');
Route::get('/dashboard/donates/{id}', [DonateController::class, 'show'])->middleware('auth:admin');
Route::get('/dashboard/donates/{id}/delete', [DonateController::class, 'destroy'])->middleware('auth:admin');

Route::get('/dashboard/adoptions', [AdoptionController::class, 'dataadoption'])->middleware('auth:admin');
Route::get('/dashboard/adoptions/{id}', [AdoptionController::class, 'show'])->middleware('auth:admin');

Route::get('/dashboard/shelters', [ShelterController::class, 'datashelter'])->middleware('auth:admin');
Route::get('/dashboard/shelters/{id}', [ShelterController::class, 'show'])->middleware('auth:admin');
Route::get('/dashboard/shelters/{id}/delete', [ShelterController::class, 'destroy'])->middleware('auth:admin');

Route::get('/dashboard/pets/checkSlug', [PetController::class, 'checkSlug' ])->middleware('auth:admin');
Route::resource('/dashboard/pets', PetController::class)->middleware('auth:admin');

Route::get('/dashboard/campaigns/checkSlug', [CampaignController::class, 'checkSlug'])->middleware('auth:admin');
Route::resource('/dashboard/campaigns', CampaignController::class)->middleware('auth:admin');

Route::get('/pets', [PetController::class, 'petall']);
Route::get('/pet/{pet:slug}', [PetController::class, "pet"]);

Route::get('/campaigns', [CampaignController::class, 'campaignall']);
Route::get('/campaign/{campaign:slug}', [CampaignController::class, "campaign"]);



Route::get('/shelters/approve/{id}', [ShelterController::class, 'approve'])->name('shelters.approve');
Route::get('/shelters/decline/{id}',  [ShelterController::class, 'decline'])->name('shelters.decline');

Route::get('/adoptions/approve/{id}', [AdoptionController::class, 'approve'])->name('adoptions.approve');
Route::get('/adoptions/decline/{id}',  [AdoptionController::class, 'decline'])->name('adoptions.decline');

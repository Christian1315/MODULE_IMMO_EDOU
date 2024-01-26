<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
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

Route::controller(HomeController::class)->group(function () {
    Route::get('/', "Home")->name("home");
    Route::post('/login', "Login")->name("login");
    Route::get('/logout', "Logout")->name("logout");
    Route::get('/demande-reinitialisation', "DemandReinitializePassword")->name("demande-reinitialisation");
});

Route::controller(AdminController::class)->group(function () {
    Route::get('dashbord', "Admin")->name("dashbord");
    Route::get('proprietor', "Proprietor")->name("proprietor");

    Route::get('house', "House")->name("house");
    Route::get('client', "Client")->name("client");
    Route::get('room', "Room")->name("room");
    Route::get('locator', "Locator")->name("locator");
    Route::get('location', "Location")->name("location");
    Route::get('count', "AccountSold")->name("count");
    Route::get('initiation', "Initiation")->name("initiation");
    Route::get('paiement', "Paiement")->name("paiement");
    Route::get('setting', "Setting")->name("setting");
    Route::get('statistique', "Statistique")->name("statistique");
    Route::get('{id}/stopHouseState', "StopHouseState")->name("stopHouseState");
    Route::get('{location}/factures', "LocationFactures")->name("locationFacture");
    Route::get('{house}/stopState', "StopState")->name("locationFacture");
});

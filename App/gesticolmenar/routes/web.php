<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiaryController;
use App\Http\Controllers\BeehiveController;

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

// Route::get('/', function () {
//     return view('login');
// });

Route::view('/', 'login');
Route::view('/register', 'register');
Route::view('/welcome', 'welcome')->name('welcome');

Route::post('/', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('beehives/beehivesApiary/{apiary}', [BeehiveController::class, 'beehivesApiary'])->name('beehives.beehivesApiary');


    Route::resource('apiaries', ApiaryController::class);
    Route::resource('beehives', BeehiveController::class);
});

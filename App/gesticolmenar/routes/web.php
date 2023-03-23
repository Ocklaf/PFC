<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiaryController;
use App\Http\Controllers\BeehiveController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\QueenController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DiseaseController;

use App\Http\Controllers\ChartController;

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

Route::view('/', 'login');
Route::view('/register', 'register');
Route::view('/welcome', 'welcome')->name('welcome');

Route::post('/', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('beehives/beehivesApiary/{apiary}', [BeehiveController::class, 'beehivesApiary'])->name('beehives.beehivesApiary');
    Route::get('beehives/addBeehiveToApiary/{apiary}', [BeehiveController::class, 'addBeehiveToApiary'])->name('beehives.addBeehiveToApiary');
    Route::get('disesases/addDiseaseToBeehive/{beehive}', [DiseaseController::class, 'addDiseaseToBeehive'])->name('diseases.addDiseaseToBeehive');

    Route::get('charts/honeyApiaries', [ChartController::class, 'honeyApiaries'])->name('charts.honeyApiaries');
    Route::get('charts/totalHoney/{years}', [ChartController::class, 'totalHoney'])->name('charts.totalHoney');
    Route::get('charts/pollenApiaries', [ChartController::class, 'pollenApiaries'])->name('charts.pollenApiaries');
    Route::get('charts/totalPollen/{years}', [ChartController::class, 'totalPollen'])->name('charts.totalPollen');
    Route::get('charts/apitoxineApiaries', [ChartController::class, 'apitoxineApiaries'])->name('charts.apitoxineApiaries');
    Route::get('charts/totalApitoxine/{years}', [ChartController::class, 'totalApitoxine'])->name('charts.totalApitoxine');



    Route::resource('apiaries', ApiaryController::class);
    Route::resource('beehives', BeehiveController::class);
    Route::resource('users', UserController::class);
    Route::resource('places', PlaceController::class);
    Route::resource('queens', QueenController::class);
    Route::resource('products', ProductController::class);
    Route::resource('diseases', DiseaseController::class);
    // Route::resource('charts', HoneyApiaryChartController::class);
});

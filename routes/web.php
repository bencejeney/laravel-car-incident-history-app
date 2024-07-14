<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchHistoryController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\IncidentController;
use App\Http\Controllers\Admin\UserController;

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

Route::get('/', [HomeController::class, 'index']);
Route::post('/search', [HomeController::class, 'search'])->name('search');
Route::get('/incident/{incident}', [IncidentController::class, 'show'])->name('incident.show');
Route::get('/search-history', [SearchHistoryController::class, 'index'])->name('search.history.index')->middleware('auth');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/vehicle/create', [VehicleController::class, 'create'])->name('admin.vehicle.create');
    Route::post('/vehicle/store', [VehicleController::class, 'store'])->name('admin.vehicle.store');
    Route::get('/vehicle/{vehicle}/edit', [VehicleController::class, 'edit'])->name('admin.vehicle.edit');
    Route::put('/vehicle/{vehicle}', [VehicleController::class, 'update'])->name('admin.vehicle.update');
    Route::get('/incident/create', [IncidentController::class, 'create'])->name('admin.incident.create');
    Route::post('/incident/store', [IncidentController::class, 'store'])->name('admin.incident.store');
    Route::get('/incident/{incident}/edit', [IncidentController::class, 'edit'])->name('admin.incident.edit');
    Route::put('/incident/{incident}', [IncidentController::class, 'update'])->name('admin.incident.update');
    Route::delete('/incident/{incident}', [IncidentController::class, 'destroy'])->name('admin.incident.destroy');
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/users/{user}/togglePremium', [UserController::class, 'togglePremium'])->name('admin.users.togglePremium');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

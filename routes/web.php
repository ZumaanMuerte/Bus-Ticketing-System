<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DispatcherController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\EarningsController;
use App\Http\Controllers\TicketSalesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [AccountController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/user', function () {
    return view('user');
})->middleware(['auth'])->name('user');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Account Management Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/account', [AccountController::class, 'index'])->name('account');
    Route::post('/account', [AccountController::class, 'store'])->name('account.store');
    Route::put('/account/{id}', [AccountController::class, 'update'])->name('account.update');
    Route::delete('/account/{id}', [AccountController::class, 'destroy'])->name('account.destroy');
});


Route::resource('conductor',ConductorController::class);
Route::resource('driver', DriverController::class);
Route::resource('dispatcher', DispatcherController::class);

//Route::put('/bus/{id}', [BusController::class, 'update'])->name('bus.update');
//Route::delete('/bus/{id}', [BusController::class, 'destroy'])->name('bus.destroy');
//Route::post('/bus', [BusController::class, 'store'])->name('bus.store');
//Route::get('/bus', [BusController::class, 'index'])->name('bus.index');
Route::resource('bus',BusController::class);

Route::resource('earning', EarningsController::class);
Route::resource('ticketsales', TicketSalesController::class);

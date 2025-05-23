<?php
use App\Http\Controllers\UserTicketController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DispatcherController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\TicketSalesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketPriceController;
use App\Http\Controllers\InBusEmployeeController;
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
// Ticket Pricing (Admin)
Route::get('ticket/price-pdf', [TicketPriceController::class, 'exportPDF'])->name('ticket.price.pdf');
Route::resource('ticket/price', TicketPriceController::class);
// Ticket Sales
Route::resource('ticket/sales', TicketSalesController::class);
// In-Bus Employees
Route::resource('in_bus_employees', InBusEmployeeController::class);

Route::resource('dispatcher', DispatcherController::class);

Route::resource('bus',BusController::class);

Route::middleware('auth')->group(function () {
    Route::get('/tickets/book', [UserTicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets/search', [UserTicketController::class, 'searchBuses'])->name('tickets.search');
    Route::post('/tickets/book', [UserTicketController::class, 'bookTicket'])->name('tickets.book');
    Route::get('/tickets/{id}', [UserTicketController::class, 'show'])->name('tickets.show');
});

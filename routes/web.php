<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\HostEventController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/about', 'about')->name('about');
Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/host-event', [HostEventController::class, 'create'])->name('host-events.create');
    Route::post('/host-event', [HostEventController::class, 'store'])->name('host-events.store');
    Route::get('/host-event/{event}/edit', [HostEventController::class, 'edit'])->name('host-events.edit');
    Route::put('/host-event/{event}', [HostEventController::class, 'update'])->name('host-events.update');
    Route::post('/events/{event}/bookmark', [BookmarkController::class, 'store'])->name('bookmarks.store');
    Route::delete('/events/{event}/bookmark', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');
    Route::post('/events/{event}/register', [EventRegistrationController::class, 'store'])->name('event-registrations.store');
    Route::delete('/events/{event}/register', [EventRegistrationController::class, 'destroy'])->name('event-registrations.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'admin'])->name('dashboard');
    Route::resource('events', EventController::class)->except(['index']);
    Route::resource('categories', CategoryController::class)->except(['show']);
});

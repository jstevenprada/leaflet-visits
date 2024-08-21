<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VisitsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('visitas')->middleware('auth')->group(function() {
    // Routes for Layouts
    Route::get('index',[VisitsController::class,'index'])->name('visitas.index');
    Route::get('create',[VisitsController::class,'create'])->name('visitas.create');
    Route::get('/{visits}/edit',[VisitsController::class,'edit'])->name('visitas.edit');

    // Routes for Rest api
    Route::post('visits',[VisitsController::class,'store'])->name('visits.store');
    Route::put('visits/{visits}',[VisitsController::class,'update'])->name('visits.update');
    Route::delete('visits/{visits}',[VisitsController::class,'destroy'])->name('visits.destroy');
});

require __DIR__.'/auth.php';

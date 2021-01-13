<?php

use App\Http\Controllers\calendarController;
use App\Http\Controllers\counselorsController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [counselorsController::class, 'index'])->name('dashboard');

Route::get('/user', [counselorsController::class, 'index']);
Route::get('/show/{student_id}', [counselorsController::class, 'show'])->name('show');
Route::get('/info/{student_id}', [counselorsController::class, 'info'])->name('info');

Route::get('/delete/{id}', [counselorsController::class, 'delete'])->name('delete');

Route::get('/active/{id}', [counselorsController::class, 'active'])->name('active');

Route::get('/dashboard/calendar', [calendarController::class, 'index'])->name('calendar');

Route::get('/dashboard/load', [calendarController::class, 'load'])->name('load_calendar');

Route::post('/dashboard/insert', [calendarController::class, 'insert'])->name('insert_calendar');

Route::post('/dashboard/edit', [calendarController::class, 'edit'])->name('edit_calendar');

Route::post('/dashboard/delete', [calendarController::class, 'delete'])->name('delete');

Route::post('/dashboard/fetch', [calendarController::class, 'fetch'])->name('fetch');

Route::get('/dashboard/gesprekken/aangevraagd', [calendarController::class, 'aangevraagd'])->name('aangevraagde_gesprekken');

Route::post('/dashboard/gesprekken/aangevraagd/edit', [calendarController::class, 'edit_aangevraagd'])->name('edit_aangevraagd');

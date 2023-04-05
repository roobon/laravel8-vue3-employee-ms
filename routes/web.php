<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StateController;
use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth')->group(function () {
  Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

  Route::resource('countries', CountryController::class);
  Route::resource('states', StateController::class);
  Route::resource('cities', CityController::class);
  Route::resource('departments', DepartmentController::class);
  Route::get('employees', function () {
    return view('pages.employees.index');
  })->name('employee');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

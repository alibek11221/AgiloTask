<?php

use App\Company;
use App\Event;
use App\Shift;
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
/**
 * @see \App\Http\Controllers\HomeController::index()
 */
Route::get('/', 'HomeController@index');
/**
 * @see \App\Http\Controllers\ShiftController
 */
Route::resource('shift', 'ShiftController');

/**
 * @see \App\Http\Controllers\CompanyController
 */
Route::resource('company', 'CompanyController');

/**
 * @see \App\Http\Controllers\EventController
 */
Route::resource('event', 'EventController');


Auth::routes();
/**
 * @see \App\Http\Controllers\HomeController::index()
 */
Route::get('/home', 'HomeController@index')->name('home');

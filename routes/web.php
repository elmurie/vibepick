<?php

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

// Rotte pubbliche
// Route::get('/', 'PageController@index')->name('homepage');
Route::get('/login', './Auth/LoginController@showLoginForm ');
Route::get('/register', './Auth/RegisterController@showRegistrationForm');

//questa rotta intercetta la richiesta api dalla pagina advanced search che ha indirizzo 127.0.0.1:8000/strumenti/api/instruments per popolare la select
Route::get('/strumenti/api/instruments', 'Api\InstrumentController@index');


// Rotte di autenticazione
Auth::routes();

// Rotte sezione Admin
Route::middleware('auth')->namespace('Admin')->name('admin.')->prefix('admin')->group(function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('users', 'UserController');
    Route::resource('messages', 'MessageController');
    Route::resource('reviews', 'ReviewController');


});

Route::get('/{any}', 'PageController@index')->where('any', '.*');

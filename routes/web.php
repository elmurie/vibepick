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
// Route::get('/', 'PageController@index')->name('homepage');


//questa rotta intercetta la richiesta api dalla pagina advanced search che ha indirizzo 127.0.0.1:8000/strumenti/api/instruments per popolare la select
Route::get('/strumenti/api/instruments', 'Api\InstrumentController@index');
//questa rotta intercetta la richiesta api dalla pagina advanced search che ha indirizzo 127.0.0.1:8000/strumenti/{nome_strumento}/api/instruments per popolare la select
Route::get('/strumenti/{any}/api/instruments', 'Api\InstrumentController@index')->where('any', '.*');
//quest rotta intercetta la richiesta api dalla pagina show artist che ha indirizzo 127.0.0.1:8000/showartist/api/showartist/{id utente}
Route::get('/showartist/api/showartist/{any}', 'Api\UserController@show')->where('any', '.*');



// Rotte di autenticazione
Auth::routes();

// Rotte sezione Admin
Route::middleware('auth')->namespace('Admin')->name('admin.')->prefix('admin')->group(function() {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('users', 'UserController@show')->name('users.show');
    Route::get('users/edit', 'UserController@edit')->name('users.edit');
    Route::put('users/update', 'UserController@update')->name('users.update');
    Route::delete('users/destroy', 'UserController@destroy')->name('users.destroy');
    // Route::resource('users', 'UserController');

    //Rotte messaggi e recensioni dei singoli user
    Route::resource('messages', 'MessageController');
    Route::resource('reviews', 'ReviewController');


});

Route::get('/{any}', 'PageController@index')->where('any', '.*');

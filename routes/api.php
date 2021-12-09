<?php
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

// Route::get('/instruments/api', 'Api\InstrumentController@index');


// http://localhost:8000/api/users
Route::namespace('Api')->name('api.')->group(function() {
	Route::get('/users', 'UserController@index');
	Route::get('/instruments', 'InstrumentController@index'); // passa tutto l'elenco degli strumenti 
	Route::get('/instruments/{slug}', 'InstrumentController@show'); // passa il singolo strumento individuato del nome con allegato la lista degli utenti con con lo strumento associato 
});
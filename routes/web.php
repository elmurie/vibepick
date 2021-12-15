<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Braintree\Gateway;

use App\User;
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
Route::post('reviews', 'ReviewController@store');
Route::post('messages', 'MessageController@store');
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


    //Rotte Sponsorships
    Route::get('/sponsorship', 'SponsorshipController@index')->name('sponsorship');

    Route::get('/check', function(){
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
    
        $token = $gateway->ClientToken()->generate();
    
        return view('admin.sponsor.checkout', compact('token'));
    });
    
    Route::post('/checkout', function(Request $request){

        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        
        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;
    
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'firstName' => 'Tony',
                'lastName' => 'Stark',
                'email' => 'tnoy@gmail.it',
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
    
        if ($result->success) {
            $transaction = $result->transaction;
            // header("Location: transaction.php?id=" . $transaction->id);
    
            return back()->with('success_message', 'Transazione riuscita. The ID is:'. $transaction->id);
        } else {
            $errorString = "";
    
            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Errore: ' . $error->code . ": " . $error->message . "\n";
            }
    
            // $_SESSION["errors"] = $errorString;
            // header("Location: index.php");
            return back()->withErrors('An error occurred with the message: '.$result->message);
        }
    });
    
});

Route::get('/{any}', 'PageController@index')->where('any', '.*');

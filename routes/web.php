<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Braintree\Gateway;

use App\User;
use App\Sponsorship;
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

    Route::get('/check/{id}', function($id){
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        
        $sponsorship=Sponsorship::find($id);
        if(!$sponsorship){
            return redirect('/404');
        };
        $token = $gateway->ClientToken()->generate();
        return view('admin.sponsor.checkout', compact('token', 'sponsorship'));
    })->name('payment');
    
    Route::post('/checkout', function(Request $request, User $user){

        
        if($user = Auth::user()){
            $gateway = new Braintree\Gateway([
                'environment' => config('services.braintree.environment'),
                'merchantId' => config('services.braintree.merchantId'),
                'publicKey' => config('services.braintree.publicKey'),
                'privateKey' => config('services.braintree.privateKey')
            ]);
            
            //Recupera i dati della sponsor grazie all'id nella request
            $sponsorship = Sponsorship::find($request->sponsor_id);
            $amount = $sponsorship->price;
            $nonce = $request->payment_method_nonce;
        
            $result = $gateway->transaction()->sale([
                'amount' => $amount,
                'paymentMethodNonce' => $nonce,
                'customer' => [
                    'firstName' => $user->firstname,
                    'lastName' => $user->lastname,
                    'email' => $user->email,
                ],
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);
        
            if ($result->success) {
                $transaction = $result->transaction;
                // header("Location: transaction.php?id=" . $transaction->id);

                // inserimento manuale del created_at per avere disponibile uno stroico privato di attivazione della sponsorship
                date_default_timezone_set('Europe/Rome');
                $created = date('Y-m-d H:i:s');
                
                //settiamo la data di partenza come oggetto DateTime
                $start_date = new DateTime($request->start_time);

                //Aggiungiamo la durata della sponsor in giorni
                $end_date = date_add($start_date, date_interval_create_from_date_string($sponsorship->duration . " days"));
                // $request->start_time + $sponsorship->duration;
                //Questo array prende i dati di inizio e fine della sponsor e li raggruppa
                $sponsor_dati = [
                    'start_time' => $request->start_time,
                    'end_time' => $end_date,
                    'created_at' =>  $created,
                ];
    
    
                //grazie all'attach colleghiamo user_id e sponsorship_id e aggiungiamo i dati ulteriori sulla durata nella tabella pivot sponsorship_user
                $user->sponsorships()->attach($request->sponsor_id, $sponsor_dati );
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
        };

        abort('403');

        
    });
    
});

Route::get('/{any}', 'PageController@index')->where('any', '.*');

<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Braintree\Gateway;

use App\User;
use App\Sponsorship;
use Illuminate\Database\Eloquent\Builder;

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

    // impostazione della timezone
    //ToDo test per vedere se cambia anche la zona al dateTime
        date_default_timezone_set('Europe/Rome');

        //Trasformazione delle date in oggetti DateTime per sfruttare la maggior precisione nei confronti 
        $nextSponsorStart = new DateTime($request->start_time);

        // date_default_timezone_set('Europe/Rome');

        //impostazione della data attuale
        //ToDo provare a darle un meno 2 minuti per evitare l'errore se si seleziona oggi nel calendario
        $now = date("Y-m-d H:i:s");
        $nowD = new DateTime($now);
        $nowDate = date_modify($nowD,"-2 minutes");

        //Se si inserisce una data precedente al momento attuale si ritorna alla pagina del pagamento con l'appposito messaggio d'errore
        if($nowDate > $nextSponsorStart){
            return back()->withErrors('Non puoi selezionare una data di inizio sponsorizzazione precedente al tempo attuale');
        }
        

        //Dati d'accesso al server Braintree
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

            //Variabile di supporto per il calcolo della fine sponsor richiesta
            $calcSponsorEnd = new DateTime($request->start_time);

            //Calcolo fine sponsor
            $nextSponsorEnd = date_add($calcSponsorEnd, date_interval_create_from_date_string($sponsorship->duration . " days"));

            //La chiamata restituisce l'oggetto con l'utente e le sponsorships a lui legate 
            $loggedUser = User::where('id', $user->id)->with('sponsorships')->get();

    //Con questa assegnazione si accede all'array di sponsorship legate all'utente
            $userSponsorships = $loggedUser[0]['sponsorships'];
            
            //Variabile di supporto per la verifica dell'accettabilità della sponsor richiesta
            $sponsorNegate = false;
    
    
    //In questo ciclo confrontiamo il tempo di fine delle sponsorship legate all'user con la nuova che vuole attivare 
            
            foreach($userSponsorships as $userSponsorship){
            
            //Trasformazione delle date in oggetti DateTime per sfruttare la maggior precisione nei confronti 
                $prevSponsorEnd = new DateTime($userSponsorship['pivot']['end_time']);

                $prevSponsorStart = new DateTime($userSponsorship['pivot']['start_time']);

            //Se la nuova sponsorizzazione ha uno start_time all'interno di un periodo di sponsorizzazione attiva si torna alla pagina con un errore
                if(($nextSponsorStart > $prevSponsorStart && $nextSponsorStart < $prevSponsorEnd) || ($nextSponsorEnd > $prevSponsorStart && $nextSponsorEnd < $prevSponsorEnd)){
                    
                    $sponsorNegate = true;

                    //Salvataggio in queste due variabili delle date della sponsor che si accavalla per poterle stampare nell'errore
                    $sponsorNegStart = $prevSponsorStart;
                    $sponsorNegEnd = $prevSponsorEnd;
                }

                //Controllo sui conflitti con le precedenti sponsor tramite la variabile di supporto
                if($sponsorNegate){
                    return back()->withErrors('La sponsorizzazione che hai cercato di attivare si accavalla con la sponsorizzazione che hai già attivato che va dal '. date_format($sponsorNegStart , 'd-m-Y') . ' alle ' . date_format($sponsorNegStart , 'H:i')  . ' e si conclude il ' . date_format($sponsorNegEnd , 'd-m-Y') . ' alle ' . date_format($sponsorNegEnd , 'H:i'));
                }
            }
            
        //Risultato transazione con i dati dell'user che vengono passati al server BrainTree
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
        
            //Transazione a buon fine
            if ($result->success) {
                $transaction = $result->transaction;

                //Setta la data di partenza come oggetto DateTime
                $start_date = new DateTime($request->start_time);
                $calcEnd = new DateTime($request->start_time);

                //Aggiunge la durata della sponsor in giorni
                $end_date = date_add($calcEnd, date_interval_create_from_date_string($sponsorship->duration . " days"));

                //Questo array prende i dati di inizio e fine della sponsor e li raggruppa
                $sponsor_dati = [
                    'start_time' => $start_date,
                    'end_time' => $end_date,
                ];
    
    
                //Grazie all'attach colleghiamo user_id e sponsorship_id e aggiungiamo i dati ulteriori sulla durata nella tabella pivot sponsorship_user
                $user->sponsorships()->attach($request->sponsor_id, $sponsor_dati );
                
                //Formattazione sponsor Start per la tra
                $startHour = date_format($nextSponsorStart, "H:i");
                $startDay = date_format($nextSponsorStart, "d-m-Y");

                //Si ritorna alla pagina con tutte le sponsorizzazioni disponibili con un messaggio 
                return redirect()->route('admin.sponsorship')->with('success_message', "Acquisto completato. Avrai la sponsor " . $sponsorship->name . " per " . $sponsorship->duration*24 . "ore. A partire dalle " . $startHour . " del " . $startDay . "\n" . ". Identificativo della transazione: ". $transaction->id);
            } else {
                //Transazione fallita
                $errorString = "";
        
                foreach ($result->errors->deepAll() as $error) {
                    $errorString .= 'Errore: ' . $error->code . ": " . $error->message . "\n";
                }
                //Si ritorna alla pagina di acquisto 
                return back()->withErrors('Errore nella transazione: '.$result->message);
            }
        };

        abort('403');

        
    });
    
});

Route::get('/{any}', 'PageController@index')->where('any', '.*');

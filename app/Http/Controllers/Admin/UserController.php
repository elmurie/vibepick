<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Instrument;
use App\User;
use DateTime;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if( $user = Auth::user() ) {
            // dd($user->id);
            // $user = Auth::user();
            // return response()->json([
            //     'data'=> $user,
            // ]);

            $userSelected = User::where('id', $user->id)
            ->with('sponsorships')
            ->get();

            $sponsorships = $userSelected['0']['sponsorships'];

            //Recupero della data odierna
            date_default_timezone_set('Europe/Rome');
            $nowD = date("Y-m-d H:i:s");

            $nowDate = new DateTime($nowD);

            $sponsLength = count($sponsorships);
            
            
            for($i = 0; $i < $sponsLength; $i++){
                $start_time = new DateTime($sponsorships[$i]['pivot']['start_time']);
                $end_time = new DateTime($sponsorships[$i]['pivot']['end_time']);
                $created_at = $sponsorships[$i]['pivot']['created_at'];
                $created_at = $created_at->format("d-m-Y h:i");

                
                //Assegnazione di una classe per l'eventuale sponsorizzazione attiva
                if(!($start_time < $nowDate && $end_time > $nowDate)){
                    unset($sponsorships[$i]);
                }else{
                    $sponsorships[$i]['pivot']['start_time'] = date_format($start_time, "d-m-Y H:i");
                    $sponsorships[$i]['pivot']['end_time'] = date_format($end_time, "d-m-Y H:i");
                    $sponsorships[$i]['pivot']['sale_time'] = $created_at;
                    $conto = $i;
                }
                
                //Formattazione delle date per la visione a video
            }


            $user = $userSelected[0];
            if(count($userSelected[0]['sponsorships']) > 0){
                $sponsorship = $userSelected[0]['sponsorships'][$conto];
                $userSelected[0]['is_sponsored'] = true;

            } else{
                $userSelected[0]['is_sponsored'] = false;
                $sponsorship = $userSelected[0]['sponsorships'];

            }

            // return response()->json([
            //     'data'=> $sponsorship,
            // ]);
            return view('admin.show', compact('user', 'sponsorship'));
        }    
        abort("403");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if( $user = Auth::user() ) {
            // $user = Auth::user();
            $instruments = Instrument::all();
            
            $userSelected = User::where('id', $user->id)
            ->with('sponsorships')
            ->get();

            $sponsorships = $userSelected['0']['sponsorships'];

            //Recupero della data odierna
            date_default_timezone_set('Europe/Rome');
            $nowD = date("Y-m-d H:i:s");

            $nowDate = new DateTime($nowD);

            $sponsLength = count($sponsorships);
            
            
            for($i = 0; $i < $sponsLength; $i++){
                $start_time = new DateTime($sponsorships[$i]['pivot']['start_time']);
                $end_time = new DateTime($sponsorships[$i]['pivot']['end_time']);
                $created_at = $sponsorships[$i]['pivot']['created_at'];
                $created_at = $created_at->format("d-m-Y h:i");

                
                //Assegnazione di una classe per l'eventuale sponsorizzazione attiva
                if(!($start_time < $nowDate && $end_time > $nowDate)){
                    unset($sponsorships[$i]);
                }else{
                    $sponsorships[$i]['pivot']['start_time'] = date_format($start_time, "d-m-Y H:i");
                    $sponsorships[$i]['pivot']['end_time'] = date_format($end_time, "d-m-Y H:i");
                    $sponsorships[$i]['pivot']['sale_time'] = $created_at;
                    $conto = $i;
                }
                
                //Formattazione delle date per la visione a video
            }


            $user = $userSelected[0];
            if(count($userSelected[0]['sponsorships']) > 0){
                $sponsorship = $userSelected[0]['sponsorships'][$conto];
                $userSelected[0]['is_sponsored'] = true;

            } else{
                $userSelected[0]['is_sponsored'] = false;
                $sponsorship = $userSelected[0]['sponsorships'];

            }
            return view('admin.edit', compact('instruments', 'user', 'sponsorship'));
        }    
        abort("403");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
        //Controllo che blocca evenutali utenti non autorizzati all'azione di modifica del profilo
        if( Auth::user() ) {

            $user = Auth::user();
                //Controllo per verificare in caso venga modificata l'email se questa ?? gi?? presente nel DB, come viene fatto anche al momento della registrazione
            if ($request['email'] != $user['email']){
                $request->validate([
                    'email' => 'required | string | email | max:255 | unique:users',
                ]);
            }

            //Questa ?? la validazione dei dati provenienti dall'edit del profilo 
            $request->validate([
                'address' => 'required | string | max:255',
                'phone_number' => 'numeric | nullable',
                'instruments' => 'required',
                'genre' => 'string | nullable | max:255 ',
                'services' => 'nullable | max:1000 ',
                'image' => 'nullable | image | max:1500',
                'curriculum' => 'nullable | max:30000 ',
                ]); 


                
                
            $supportArray = $request->all();

            //Questa ?? la gestione del file immagine della foto profilo, il file viene caricato corrispondente alla chiave 'image'
            //tutta la request inserita in un array di supporto, se l'immagine ?? presente viene cancellata l'immagine gi?? presente in memoria
            //legata all'user e viene sostituita con la nuova immagine

            if(array_key_exists('image', $supportArray)){

                if($user['profile_pic']){
                    Storage::delete($user['profile_pic']);
                }

                $profile_path = Storage::put('profile_pics', $supportArray['image']);
                $supportArray['profile_pic'] = $profile_path;

                //Inserimento dell'evenutale nuova foto profilo nel record user del DB
                $user->profile_pic = $supportArray['profile_pic'];
            }

            //Inserimento dei rimanenti campi modificabili nel record user del DB
            $user->firstname = $user->firstname; 
            $user->lastname = $user->lastname;
            $user->address = $request->address;
            $user->phone_number = $request->phone_number;
            $user->email = $user->email;
            $user->genre = $request->genre;
            $user->password = $user->password;
            $user->services = $request->services;
            $user->curriculum = $request->curriculum;
            $user->save();

            //Qui viene eseguito il sync sugli strumenti che hanno una relazione Many-to-Many con gli user
            $user->instruments()->sync($request->instruments);

            //Qui rimandiamo alla pagina home della sezione per utenti autorizzati
            // return view('admin.home', compact('user'));

            return redirect()->route('admin.home', compact('user'))->with('record_updated', 'Il profilo ?? stato aggiornato');
        }  
        abort("403");
        
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Request $request)
    {
        $user = Auth::user();
        if( !Auth::user() ) {
            abort("403");
        }

        
        $user->delete();
        
        return redirect('/');
        

    }
}

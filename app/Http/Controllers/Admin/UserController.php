<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Instrument;
use App\User;



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
        return view('admin.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if( $user->id != Auth::id() ) {
            abort("403");
        }    
        $instruments = Instrument::all();
        return view('admin.edit', compact('user', 'instruments'));
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
        
        // Questo è un controllo che blocca evenutali utenti non autorizzati all'azione di modifica del profilo
        if( $user->id != Auth::id() ) {
            abort("403");
        }  

        //qui c'è il controllo per verificare in caso venga modificata l'email se questa è già presente nel DB, come viene fatto anche al momento della registrazione

        if ($request['email'] != $user['email']){
            $request->validate([
                'email' => 'required | string | email | max:255 | unique:users',
            ]);
        }

        //Questa è la validazione dei dati provenienti dall'edit del profilo 
        $request->validate([
            'address' => 'required | string | max:255',
            'phone_number' => 'numeric | nullable',
            'instruments' => 'required',
            'genre' => 'string | nullable | max:255 ',
            'services' => 'string | nullable | max:255 ',
            'image' => 'nullable | image | max:1500',
            ]); 


            
            
        $supportArray = $request->all();


        //Questa è la gestione del file immagine della foto profilo, il file viene caricato corrispondente alla chiave 'image'
        //tutta la request inserita in un array di supporto, se l'immagine è presente viene cancellata l'immagine già presente in memoria
        //legata all'user e viene sostituita con la nuova immagine

        if(array_key_exists('image', $supportArray)){

            if($user['profile_pic']){
                Storage::delete($user['profile_pic']);
            }

            $profile_path = Storage::put('profile_pics', $supportArray['image']);
            $supportArray['profile_pic'] = $profile_path;

            //questo è l'inserimento dell'evenutale nuova foto profilo nel record user del DB
            $user->profile_pic = $supportArray['profile_pic'];
        }

        //questo è l'inserimento dei rimanenti campi modificabili nel record user del DB

        $user->firstname = $user->firstname; 
        $user->lastname = $user->lastname;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->email = $user->email;
        $user->genre = $request->genre;
        $user->password = $user->password;
        $user->services = $request->services;
        $user->save();

        //Qui viene eseguito il sync sugli strumenti che hanno una relazione Many-to-Many con gli user
        $user->instruments()->sync($request->instruments);

        //Qui rimandiamo alla pagina home della sezione per utenti autorizzati
        return view('admin.home', compact('user'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Request $request)
    {

        if( $user->id != Auth::id() ) {
            abort("403");
        }
        if (empty($request->id)) {
            $user->delete();
        } else {
            $request->delete();
        }

        return redirect()->route("homepage");
    }
}

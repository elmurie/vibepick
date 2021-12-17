<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Instrument;
use App\Review;
use App\User;


class InstrumentController extends Controller
{
    public function index()
    {
        $instruments = Instrument::all();

        return response()->json([
            'success' => true,
            'data' => $instruments
        ]);
    }

    // ----------- CHIAMATE PER LA RICERCA UTENTI IN ADVANCED SEARCH -----------

    public function show($slug, $rewMin, $avgVote)
    {

            date_default_timezone_set('Europe/Rome');
            $nowDate = date("Y-m-d H:i:s");



//----------------- Chiamata per gli utenti che hanno una sponsorizzazione attiva
        $usersSponsor = User::whereHas('instruments', function (Builder $query) use($slug){
            $query->where('slug', $slug);
        })
        ->whereHas('sponsorships', function(Builder $query) use($nowDate){
            $query->where('end_time', '>', $nowDate)->where('start_time', '<', $nowDate);
        })
        //Per contare il numero di review
        ->withCount('reviews')
        //Richiesta in base alla condizione sul numero di review
        ->having('reviews_count', '>=', $rewMin)
        //collego tutte le review perché sono una pippa e devo usarle per applicare la condizione sulla media voto
        ->with('reviews')->get();


//------------Chiamata per utenti senza sponsor attive ma che ne hanno almeno una acquistata (scaduta o con attivazione futura)
        $usersNotActiveSponsor = User::whereHas('instruments', function (Builder $query) use($slug){
            $query->where('slug', $slug);
        })
        ->whereHas('sponsorships', function(Builder $query) use($nowDate){
            $query->where('end_time', '<', $nowDate)->orWhere('start_time', '<', $nowDate);
        })
        //conto il numero di review
        ->withCount('reviews')
        //imposto la condizione sul numero di review
        ->having('reviews_count', '>=', $rewMin)
        //collego tutte le review perché sono una pippa e devo usarle per applicare la condizione sulla media voto
        ->with('reviews')->get();

        $notSponsorLength = count($usersNotActiveSponsor);
        
        //L'array delle persone con delle sponsor non attive ha qualche dato?
        if($notSponsorLength > 0){

            //Per ogni elemento dell'array di persone con sponsor non attive controlliamo se ne ha anche una attiva
            for($i =  0; $i < $notSponsorLength; $i++){
                
                //variabile di supporto per la verifica dell'eventuale sponsor attiva
                $isNowSponsored = false;
                
                //ciclo su tutte le sponsorizzazioni legate al singolo utente
                foreach($usersNotActiveSponsor[$i]['sponsorships'] as $sponsorship ){
                    
                    //Se una delle sponsor legate all'utente comprende il giorno attuale
                    if($sponsorship['pivot']['end_time'] > $nowDate && $sponsorship['pivot']['start_time'] < $nowDate){
                        
                        //la variabile di supporto viene settata a true
                        $isNowSponsored = true;
                        
                    }
                };

                //Se la variabile di supporto è true l'elemento dell'array collegato all'utente viene cancellato
                if($isNowSponsored){
                    unset($usersNotActiveSponsor[$i]);
                }
            }
        }

// ----------------- Chiamata per gli utenti che non hanno mai attivato una sponsorizzazione

        $usersNotSponsor = User::whereHas('instruments', function (Builder $query) use($slug){
            $query->where('slug', $slug);
        })->doesntHave('sponsorships')
        //conto il numero di review
        ->withCount('reviews')
        //imposto la condizione sul numero di review
        ->having('reviews_count', '>=', $rewMin)
        //collego tutte le review perché sono una pippa e devo usarle per applicare la condizione sulla media voto
        ->with('reviews')->get();

        //Definizione di un array vuoto che sarà di supporto per la risposta dell'API
        $users = [];

    //Riempimento risposta con gli utenti che rispettano i criteri di ricerca
        //Ciclo utenti hanno una sponsorizzazione attiva
        foreach ($usersSponsor as $sponsor) {
            $users[]=$sponsor;
        }

        //Ciclo utenti che hanno almeno una sponsorizzazione non attiva
        foreach ($usersNotActiveSponsor as $sponsor) {
            $users[]=$sponsor;
        }

        //Ciclo utenti che non hanno mai attivato una sponsorizzazione
        foreach ($usersNotSponsor as $sponsor) {
            $users[]=$sponsor;
        }
        
        //Settaggio vuoto l'array di risposta dell'API
        $usersFiltered = [];

        //Ciclo per riempire l'array di risposta con il dato aggiuntivo della media voto se la condizione su quest'ultima è verificato
        foreach($users as $user){

            //Si setta a 0 il totale dei voti e la media
            $totVote = 0;
            $averageVote = 0;
            $user['avgVote'] = 0;

            //Il reviews_count viene passato dalla query, si entra nell'if solo se c'è alemeno una review
            if($user['reviews_count'] > 0){

                //ciclo su tutte le review dell'utente per ottenere la somma voti
                foreach($user['reviews'] as $review){
                    $totVote += $review['vote'];
                }

                //eseguo il calcolo della media
                $averageVote = $totVote/$user['reviews_count'];
                $user['avgVote'] = round($averageVote, 1);
            }

            //se la media è maggiore di quella richiesta inietto l'utente nell'array che fungerà da risposta
            if( $averageVote >= $avgVote){
                $usersFiltered[] = $user;
            }
        }
        return response()->json([
            'success' => true,
            'data' => $usersFiltered,
        ]);
    }
}
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

    public function show($slug, $rewMin, $avgVote)
    {

            // date_default_timezone_set('Europe/Rome');
            // $nowDate = date("Y-m-d H:i:s");
            // $prova = "2021-12-23 10:44:00";
            // $cond = $prova > $nowDate;
            // dd($cond);
        //eseguo la chiamata su user selezionando in base allo strumento
        // $usersSponsor = User::whereHas('instruments', function (Builder $query) use($slug){
        //     $query->where('slug', $slug);
        // })->with('sponsorships')
        // ->whereHas('sponsorships', function(Builder $query){
        //     // date_default_timezone_set('Europe/Rome');
        //     // $nowDate = date("Y-m-d H:i:s");
            // $nowDate = date("2021-12-17 12:32:00");
        //     // dd($nowDate);
        //     $query->where('end_time', '>', $nowDate)->where('start_time', '<', $nowDate);
        // })
        // //conto il numero di review
        // ->withCount('reviews')
        // //imposto la condizione sul numero di review
        // ->having('reviews_count', '>=', $rewMin)
        // //collego tutte le review perché sono una pippa e devo usarle per applicare la condizione sulla media voto
        // ->with('reviews')->get();

//-----------------Così la not sponsor funziona con quelli che hanno una sola sponsor ma che non è attiva (scaduta o attivazione futura)

        // $usersNotSponsor = User::whereHas('instruments', function (Builder $query) use($slug){
        //     $query->where('slug', $slug);
        // })
        // // ->doesntHave('sponsorships')
        // ->whereHas('sponsorships', function(Builder $query){
        //     // date_default_timezone_set('Europe/Rome');
        //     // $nowDate = date("Y-m-d H:i:s");
        //     $nowDate = date("2021-12-17 12:32:00");
        //     // dd($nowDate);
        //     $query->where('end_time', '<', $nowDate)->whereOr('start_time', '<', $nowDate);
        // })
        // //conto il numero di review
        // ->withCount('reviews')
        // //imposto la condizione sul numero di review
        // ->having('reviews_count', '>=', $rewMin)
        // //collego tutte le review perché sono una pippa e devo usarle per applicare la condizione sulla media voto
        // ->with('reviews')->get();


//------------Chiamata per utenti senza sponsor attive ma che ne hanno almeno una acquistata (scaduta o con attivazione futura)
        $usersNotSponsor = User::whereHas('instruments', function (Builder $query) use($slug){
            $query->where('slug', $slug);
        })
        // ->doesntHave('sponsorships')
        ->whereHas('sponsorships', function(Builder $query){
            // date_default_timezone_set('Europe/Rome');
            // $nowDate = date("Y-m-d H:i:s");
            $nowDate = date("2021-12-25 12:32:00");
            // dd($nowDate);
            $query->where('end_time', '<', $nowDate)->whereOr('start_time', '<', $nowDate);
        })
        //conto il numero di review
        ->withCount('reviews')
        //imposto la condizione sul numero di review
        ->having('reviews_count', '>=', $rewMin)
        //collego tutte le review perché sono una pippa e devo usarle per applicare la condizione sulla media voto
        ->with('reviews')->get();

        $notSponsorLength = count($usersNotSponsor);

        //l'array delle persone con delle sponsor non attive ha qualche dato?
        if($notSponsorLength > 0){
            $nowDate = date("2021-12-25 12:32:00");

            //Per ogni elemento dell'array di persone con sponsor non attive controlliamo se ne ha anche una attiva
            for($i =  0; $i < $notSponsorLength; $i++){
                
                //variabile di supporto per la verifica dell'eventuale sponsor attiva
                $isNowSponsored = false;

                //ciclo su tutte le sponsorizzazioni legate al singolo utente
                foreach($usersNotSponsor[$i]['sponsorships'] as $sponsorship ){
                    
                    //Se una delle sponsor legate all'utente comprende il giorno attuale
                    if($sponsorship['pivot']['end_time'] > $nowDate && $sponsorship['pivot']['start_time'] < $nowDate){
                        
                        //la variabile di supporto viene settata a true
                        $isNowSponsored = true;
                        
                    }
                };

                //Se la variabile di supporto è true l'elemento dell'array collegato all'utente viene cancellato
                if($isNowSponsored){
                    unset($usersNotSponsor[$i]);
                }
            }
        }

// ----------------- Ci sarebbe bisogno della chiamata per tutti quelli che non hanno mai attivato sponsor usando il doesntHave('sponsorship')

        $users = [];
        // foreach ($usersSponsor as $sponsor) {
        //     $users[]=$sponsor;
        // }
        foreach ($usersNotSponsor as $sponsor) {
        $users[]=$sponsor;
        }

        //setto vuoto l'array di risposta
        $usersFiltered = [];
        foreach($users as $user){
            //Setto a 0 il totale dei voti e la media

            $totVote = 0;
            $averageVote = 0;
            $user['avgVote'] = 0;
            //il reviews_count ci viene passato dalla query, entriamo nell'if solo se c'è alemeno una review
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
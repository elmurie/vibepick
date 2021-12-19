<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Instrument;
use App\User;

class UserController extends Controller
{
    public function index()
    {   //prendi gli user con le recensioni solo se hanno almeno uno strumento assegnato
        $users = User::with('reviews')->with('instruments')->whereHas('sponsorships', function(Builder $query){
            date_default_timezone_set('Europe/Rome');
            $nowDate = date("Y-m-d H:i:s");
            $query->where('end_time', '>', $nowDate)->where('start_time', '<', $nowDate);
        })
        ->with('instruments')
        ->withCount('reviews')
        ->get();

        $usersFiltered = [];
        foreach($users as $user){
            //ToDo rendere questo snippet di codice una funzione da richiamare qui e nello show in modo da non ripetere
            $vote=0;
            $average=0;
            if($user['reviews_count'] > 0) {
                foreach ($user['reviews'] as $review) {
                    $vote+= $review['vote'];
                }
        
                $avg = $vote/$user['reviews_count'];
                $average=round($avg, 1);
            }

            //Si aggiunge il booleano per contrassegnare gli sponsorizzati
            $user['sponsored'] = true;
            $user['avgVote'] = $average;
            $usersFiltered[] = $user;
        }
        
        
        

        return response()->json([
            'success' => true,
            'data' => $usersFiltered,
        ]);
    }

    public function indexnotsponsored()
    {
        date_default_timezone_set('Europe/Rome');
        $nowDate = date("Y-m-d H:i:s");
        
        $usersNotActiveSponsor = User::with('instruments')
        ->whereHas('sponsorships', function(Builder $query) use($nowDate){
            $query->where('end_time', '<', $nowDate)->orWhere('start_time', '>', $nowDate);
        })
        ->withCount('reviews')
        ->with('reviews')
        ->get();

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


        $usersNotSponsor = User::with('instruments')
        ->doesntHave('sponsorships')
        ->withCount('reviews')
        ->with('reviews')->get();

    //Definizione di un array vuoto che sarà di supporto per la risposta dell'API
        $users = [];

    //Riempimento risposta con gli utenti che rispettano i criteri di ricerca

        //Ciclo utenti che hanno almeno una sponsorizzazione non attiva
        foreach ($usersNotActiveSponsor as $sponsor) {
            $users[]=$sponsor;
        }

        //Ciclo utenti che non hanno mai attivato una sponsorizzazione
        foreach ($usersNotSponsor as $sponsor) {
            $users[]=$sponsor;
        }


        $usersFiltered = [];
        foreach($users as $user){
            //ToDo rendere questo snippet di codice una funzione da richiamare qui e nello show in modo da non ripetere
            $vote=0;
            $average=0;
            if($user['reviews_count'] > 0) {
                foreach ($user['reviews'] as $review) {
                    $vote+= $review['vote'];
                }
        
                $avg = $vote/$user['reviews_count'];
                $average=round($avg, 1);
            }

            //Si aggiunge il booleano per contrassegnare gli sponsorizzati
            $user['sponsored'] = false;
            $user['avgVote'] = $average;
            $usersFiltered[] = $user;
        }

        return response()->json([
            'success' => true,
            'data' => $usersFiltered,
        ]);
    }

    public function show($id) {
        $user=User::find($id)
        ->whereHas('instruments', function (Builder $query) use($id){
            $query->where('user_id', $id);
        })
        ->with('instruments')
        ->with('reviews')
        ->withCount('reviews')
        ->get();
        
        $vote=0;
        $average=0;

        $user=$user[0];
        if($user['reviews_count'] > 0) {
            foreach ($user['reviews'] as $review) {
                $vote+= $review['vote'];
            }
            $avg = $vote/$user['reviews_count'];
            $average=round($avg, 1);
        }

        $user['avgVote'] = $average;

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

}

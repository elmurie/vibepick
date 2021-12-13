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

        //Chiamata sugli utenti 
        
        // $users = User::with('instruments','reviews')->get();
        // $users = User::with('instruments')->where('instruments_id', 1)->get();
        // $users = Instrument::with('users')->where('slug',$slug)->get();
            // $users = Review::with('users')->where('vote', '>', 2)->get();

            // $users = User::find(1)->reviews;

        //Questa prende gli utenti che suonano lo strumento $slug
            // $users = Instrument::where('slug', $slug)->with('users')->get();
        
        //Questa richiama gli utenti che hanno recensioni con voti maggioni di un valore e porta con se le reviews
            // $users = User::whereHas('reviews', function (Builder $query){
            //     $query->where('vote', '>', 4);
            // })->with('reviews')->get();

    // Questa richiama gli utenti che suonano quello strumento
        // $users = User::whereHas('instruments', function (Builder $query) use($slug){
        //     $query->where('slug', $slug);
        // })
        // ->withCount('reviews')->having('reviews_count', '>=', $rewMin)
        // ->whereHas('reviews', function (Builder $query) use ($avgVote){
        //     $query->where('user_id' ,1);
        // })->with('reviews')->get();

                //eseguo la chiamata su user selezionando in base allo strumento
        $users = User::whereHas('instruments', function (Builder $query) use($slug){
            $query->where('slug', $slug);
        })
        //conto il numero di review
        ->withCount('reviews')
        //imposto la condizione sul numero di review
        ->having('reviews_count', '>=', $rewMin)
        //collego tutte le review perché sono una pippa e devo usarle per applicare la condizione sulla media voto
        ->with('reviews')->get();


        //setto vuoto l'array di risposta
        $usersFiltered = [];
        
        foreach($users as $user){
            //Setto a 0 il totale dei voti e la media
            $totVote = 0;
            $averageVote = 0;
            //il reviews_count ci viene passato dalla query, entriamo nell'if solo se c'è alemeno una review
            if($user['reviews_count'] > 0){
                //ciclo su tutte le review dell'utente per ottenere la somma voti
                foreach($user['reviews'] as $review){
                    $totVote += $review['vote'];
                }
                //eseguo il calcolo della media
                $averageVote = $totVote/$user['reviews_count'];
            }
            //se la media è maggiore di quella richiesta inietto l'utente nell'array che fungerà da risposta
            if( $averageVote >= $avgVote){
                $usersFiltered[] = $user;
            }
        }

                // foreach($users as $user){
                //     $totVote = 0;
                //     $reviewTot=0;
                //     foreach($user['instruments'] as $instrument){
                //         if($instrument['slug'] == $slug){
                //             if(count($user['reviews']) > 0){
                //                 $reviewTot = count($user['reviews']); 
                //             }
                            
                //             // dd($reviewTot);
                //             if($reviewTot >= $rewMin){
                //                 foreach($user['reviews'] as $review){
                //                     // dd($review['vote']);
                //                     $totVote += $review['vote'];
                //                 }
                //                 if($reviewTot > 0){
                //                     $averageVote = $totVote / $reviewTot;
                //                 } else{
                //                     $averageVote = 0;
                //                 }
                //                 if( $averageVote >= $avgVote){
                //                     $usersFiltered[] = $user;
                //                 }
                //             }

                //         }
                //         }
                //     }
                    
                    // dd($usersFiltered);
        return response()->json([
            'success' => true,
            'data' => $usersFiltered,
        ]);
    }
}

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

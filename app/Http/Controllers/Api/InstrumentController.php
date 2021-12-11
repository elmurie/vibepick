<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        
        $users = User::with('instruments')->with('reviews')->get();

        $usersFiltered = [];
        
                foreach($users as $user){
                    $totVote = 0;
                    $reviewTot=0;
                    foreach($user['instruments'] as $instrument){
                        if($instrument['slug'] == $slug){
                            if(count($user['reviews']) > 0){
                                $reviewTot = count($user['reviews']); 
                            }
                            
                            // dd($reviewTot);
                            if($reviewTot >= $rewMin){
                                foreach($user['reviews'] as $review){
                                    // dd($review['vote']);
                                    $totVote += $review['vote'];
                                }
                                if($reviewTot > 0){
                                    $averageVote = $totVote / $reviewTot;
                                } else{
                                    $averageVote = 0;
                                }
                                if( $averageVote >= $avgVote){
                                    $usersFiltered[] = $user;
                                }
                            }

                        }
                        }
                    }
                    
                    // dd($usersFiltered);
        return response()->json([
            'success' => true,
            'data' => $usersFiltered,
        ]);
    }
}
